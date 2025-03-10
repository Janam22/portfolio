<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\DataSetting;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use Illuminate\Support\Carbon;
use App\Models\SystemSetting;
use App\CentralLogics\SMS_module;
use Illuminate\Support\Facades\DB;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Mail\AdminPasswordResetMail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Modules\Gateways\Traits\SmsGateway;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    public function login($login_url)
    {
        $language = SystemSetting::where('key', 'system_language')->first();
        if($language){
            foreach (json_decode($language->value, true) as $key => $data) {
                if ($data['default'] == true) {
                    $lang= $data['code'];
                    $direction= $data['direction'];
                }
            }
        }
        $data=array_column(DataSetting::whereIn('key',['admin_login_url'
        ])->get(['key','value'])->toArray(), 'value', 'key');

        $loginTypes = [
            'admin' => 'admin_login_url'
        ];

        $siteDirections = [
            'admin' => session()?->get('site_direction') ?? $direction ??  'ltr'
        ];
        $locals = [
            'admin' => session()?->get('local') ?? $lang ?? 'en'
        ];
        $role = null;

        $user_type = array_search($login_url,$data);
        abort_if(!$user_type, 404 );
        $role = array_search($user_type,$loginTypes,true);

        abort_if(!$role,404);

        $site_direction = $siteDirections[$role];
        $locale = $locals[$role];
        App::setLocale($locale);

        $custome_recaptcha = new CaptchaBuilder;
        $custome_recaptcha->build();
        Session::put('six_captcha', $custome_recaptcha->getPhrase());

        $email =  null;
        $password = null;
        if (Cookie::has('p_token') && Cookie::has('e_token') && Cookie::has('role')  &&  Cookie::get('role') == $role) {
            $email = Crypt::decryptString(Cookie::get('e_token'));
            $password = Crypt::decryptString(Cookie::get('p_token'));
        }

        return view('auth.login', compact('custome_recaptcha','email','password','role','site_direction','locale'));
    }

    public function login_attemp($role,$email ,$password, $remember = false){
        $auth = ($role == 'admin') ? 'admin' : null;

        $user = Admin::where('email', $email)->first();
        if ($user->status == 0) {
            return ['status' => false, 'message' => 'Your account is inactive. Please contact the admin.'];
        }

        if (auth($auth)->attempt(['email' => $email, 'password' => $password], $remember)) {

            if ($remember) {
                Cookie::queue('role', $role, 120);
                Cookie::queue('e_token', Crypt::encryptString($email), 120);
                Cookie::queue('p_token', Crypt::encryptString($password), 120);
            } else {
                $user = auth($auth)?->user();
                $user?->update([
                    'remember_token' => null
                ]);
                Cookie::forget('role');
                Cookie::forget('e_token');
                Cookie::forget('p_token');
            }

            return ['status' => true, 'role' => $auth];
        } 

        return false;
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $recaptcha = Helpers::get_business_settings('recaptcha');
        if (isset($recaptcha) && $recaptcha['status'] == 1 && !$request?->set_default_captcha) {
            $request->validate([
                'g-recaptcha-response' => [
                    function ($attribute, $value, $fail) {
                        $secret_key = Helpers::get_business_settings('recaptcha')['secret_key'];
                        $gResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                            'secret' => $secret_key,
                            'response' => $value,
                            'remoteip' => \request()->ip(),
                        ]);

                        if (!$gResponse->successful()) {
                            $fail(translate('ReCaptcha Failed'));
                        }
                    },
                ],
            ]);
        } else if (strtolower(session('six_captcha')) != strtolower($request->custome_recaptcha)) {
            Toastr::error(translate('messages.ReCAPTCHA Failed'));
            return back();
        }

        $data=$this->login_attemp($request->role,$request->email ,$request->password, $request->remember);

        if (is_array($data) && isset($data['status']) && $data['status'] == true) {
            return redirect()->route($data['role'].'.dashboard');
        } else {
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['Credentials does not match.']);
        }
    }

    public function reloadCaptcha()
    {
        $custome_recaptcha = new CaptchaBuilder;
        $custome_recaptcha->build();
        Session::put('six_captcha', $custome_recaptcha->getPhrase());

        return response()->json([
            'view' => view('auth.custom-captcha', compact('custome_recaptcha'))->render()
        ], 200);
    }

    public function user_reset_password_request(Request $request)
    {
        $request->validate([
            'email'=> 'required',
            'role' => 'required'
        ]);
        $user = Admin::where('email',$request['email'])->first();

        if (isset($user)) {
            $token = Helpers::generate_reset_password_code();
            DB::table('password_resets')->insert([
                'email' => $user['email'],
                'token' => $token,
                'created_by' => $request->role,
                'created_at' => now(),
            ]);
            $url = url('/').'/password-reset?token='.$token;
            try {
                if(config('mail.status') && $user['email'] && Helpers::get_mail_status('forget_password_mail_status_admin')== '1'){
                    Mail::to($user['email'])->send(new AdminPasswordResetMail($url,$user['f_name']));
                    session()->put('log_email_succ',1);
                }else {
                    Toastr::error(translate('messages.Failed_to_send_mail'));
                }
            } catch (\Throwable $th) {
                info($th->getMessage());
                Toastr::error(translate('messages.Failed_to_send_mail'));
            }
            return back();
        }
        Toastr::error(translate('messages.Email_does_not_exists'));
        return back();
    }

    public function reset_password_submit(Request $request)
    {
        $request->validate([
            'reset_token'=> 'required',
            'password' => ['required', Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
            'confirm_password'=> 'required|same:password',
        ],[
            'password.min_length' => translate('The password must be at least :min characters long'),
            'password.mixed' => translate('The password must contain both uppercase and lowercase letters'),
            'password.letters' => translate('The password must contain letters'),
            'password.numbers' => translate('The password must contain numbers'),
            'password.symbols' => translate('The password must contain symbols'),
            'password.uncompromised' => translate('The password is compromised. Please choose a different one'),
            'password.custom' => translate('The password cannot contain white spaces.'),
        ]);
        $data = DB::table('password_resets')->where(['token' => $request['reset_token']])->first();
        if (isset($data)) {
            if ($request['password'] == $request['confirm_password']) {
                DB::table('admins')->where(['email' => $data->email])->update([
                    'password' => bcrypt($request['confirm_password'])
                ]);
                if($data->created_by == 'admin'){
                    $user_link = Helpers::get_login_url('admin_login_url');
                }
                DB::table('password_resets')->where(['token' => $request['reset_token']])->delete();
                Toastr::success(translate('messages.password_changed_successfully'));
                return to_route('login',[$user_link]);
            }
        }
        Toastr::error(translate('messages.something_went_wrong'));
        return back();

    }
    public function reset_password(Request $request)
    {
        $language = SystemSetting::where('key', 'system_language')->first();
        if($language){
            foreach (json_decode($language->value, true) as $key => $data) {
                if ($data['default'] == true) {
                    $lang= $data['code'];
                    $direction= $data['direction'];
                }
            }
        }
        $site_direction = session()?->get('site_direction') ?? $direction ??  'ltr';
        $locale = session()?->get('local') ??  $lang ?? 'en';
        App::setLocale($locale);

        $data = DB::table('password_resets')->where(['token' => $request['token']])->first();
        if(!$data || Carbon::parse($data->created_at)->diffInMinutes(Carbon::now()) >= 60){
            Toastr::error(translate('messages.link_expired'));
            return redirect()->route('home');
        }
        $token = $request['token'];
        if($data->created_by == 'admin'){
            $admin = Admin::where('email',$data->email)->where('role_id',1)->first();
            return view('auth.reset-password', compact('token','admin','site_direction','locale'));
        }
    }

    public function logout()
    {
        try {
            if (auth()?->guard('admin')?->user()?->role_id == 1) {
                $user_link = Helpers::get_login_url('admin_login_url');
            }
            auth()?->guard('admin')?->logout();
            return to_route('login',[$user_link]);
        } catch (\Throwable $th) {
            return to_route('home');
        }

    }

    public function otp_resent(Request $request){
        $data = DB::table('password_resets')->where(['token' => $request['token']])->first();
        if(!$data || Carbon::parse($data->created_at)->diffInMinutes(Carbon::now()) >= 60){
                return response()->json(['errors' => 'link_expired']);
        }
        $notification_status= Helpers::getNotificationStatusData('admin','forget_password');

        if($notification_status?->sms_status == 'inactive'){
            return response()->json(['otp_fail' => 'otp_fail' ]);
        }

        if($data->created_by == 'admin'){

            $admin = Admin::where('email',$data->email)->where('role_id',1)->first();
            $otp = rand(10000, 99999);
            DB::table('phone_verifications')->updateOrInsert(['phone' => $admin['phone']],
                [
                'token' => $otp,
                'otp_hit_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                ]);
                $published_status = addon_published_status('Gateways');

                if($published_status == 1){
                    $response = SmsGateway::send($admin['phone'],$otp);
                }else{
                    $response = SMS_module::send($admin['phone'],$otp);
                }
            if($response != 'success')
            {
                return response()->json(['otp_fail' => 'otp_fail' ]);
            }
            return response()->json(['success' => 'otp_send' ]);

        }
    }
}
