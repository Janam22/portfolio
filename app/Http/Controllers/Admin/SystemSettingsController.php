<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Processor;
use App\Models\DataSetting;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\CentralLogics\Helpers;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SystemSettingsController extends Controller
{
    use Processor;

    public function system_index($tab = 'system')
    {
        if (!Helpers::module_permission_check('settings')) {
            Toastr::error(translate('messages.access_denied'));
            return back();
        }
        if ($tab == 'system') {
            return view('admin-views.system-settings.system-index');
        }
    }

    public function system_setup(Request $request)
    {

        if (env('APP_MODE') == 'demo') {
            Toastr::info(translate('messages.update_option_is_disable_for_demo'));
            return back();
            }

        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|max:2048',
            'icon' => 'nullable|max:2048',
        ]);

        if ($validator->fails()) {
        Toastr::error( translate('Image size must be within 2mb'));
        return back();
        }

        $key =['logo','icon',];
        $settings =  array_column(SystemSetting::whereIn('key', $key)->get()->toArray(), 'value', 'key');

        SystemSetting::query()->updateOrInsert(['key' => 'country_picker_status'], [
            'value' => $request['country_picker_status'] ? $request['country_picker_status'] : 0
        ]);
        SystemSetting::query()->updateOrInsert(['key' => 'system_name'], [
            'value' => $request['system_name']
        ]);

        SystemSetting::query()->updateOrInsert(['key' => 'timezone'], [
            'value' => $request['timezone']
        ]);

        if ($request->has('logo')) {

            $image_name = Helpers::update( dir: 'system/', old_image:$settings['logo'],format: 'png',image: $request->file('logo'));
        } else {
            $image_name = $settings['logo'];
        }

        SystemSetting::query()->updateOrInsert(['key' => 'logo'], [
            'value' => $image_name
        ]);

        if ($request->has('icon')) {

            $image_name = Helpers::update( dir: 'system/', old_image:$settings['icon'], format:'png', image: $request->file('icon'));
        } else {
            $image_name = $settings['icon'];
        }

        SystemSetting::query()->updateOrInsert(['key' => 'icon'], [
            'value' => $image_name
        ]);

        SystemSetting::query()->updateOrInsert(['key' => 'phone'], [
            'value' => $request['phone']
        ]);

        SystemSetting::query()->updateOrInsert(['key' => 'email_address'], [
            'value' => $request['email']
        ]);

        SystemSetting::query()->updateOrInsert(['key' => 'address'], [
            'value' => $request['address']
        ]);

        SystemSetting::query()->updateOrInsert(['key' => 'footer_text'], [
            'value' => $request['footer_text']
        ]);

        SystemSetting::query()->updateOrInsert(['key' => 'country'], [
            'value' => $request['country']
        ]);

        SystemSetting::query()->updateOrInsert(['key' => 'timeformat'], [
            'value' => $request['time_format']
        ]);
        
        SystemSetting::query()->updateOrInsert(['key' => 'client_count'], [
            'value' => $request['client_count']
        ]);
        
        SystemSetting::query()->updateOrInsert(['key' => 'project_count'], [
            'value' => $request['project_count']
        ]);
        
        SystemSetting::query()->updateOrInsert(['key' => 'service_count'], [
            'value' => $request['service_count']
        ]);

        SystemSetting::query()->updateOrInsert(['key' => 'team_count'], [
            'value' => $request['team_count']
        ]);

        Toastr::success( translate('Successfully updated. To see the changes in app restart the app.'));
        return back();
    }

    public function mail_index()
    {
        return view('admin-views.system-settings.mail-index');
    }

    public function mail_config(Request $request)
    {
        if (env('APP_MODE') == 'demo') {
            Toastr::info(translate('messages.update_option_is_disable_for_demo'));
            return back();
        }
        SystemSetting::updateOrInsert(
            ['key' => 'mail_config'],
            [
                'value' => json_encode([
                    "status" => $request['status'],
                    "name" => $request['name'],
                    "host" => $request['host'],
                    "driver" => $request['driver'],
                    "port" => $request['port'],
                    "username" => $request['username'],
                    "email_id" => $request['email'],
                    "encryption" => $request['encryption'],
                    "password" => $request['password']
                ]),
                'updated_at' => now()
            ]
        );
        Toastr::success(translate('messages.configuration_updated_successfully'));
        return back();
    }

    public function mail_config_status(Request $request)
    {
        if (env('APP_MODE') == 'demo') {
            Toastr::info(translate('messages.update_option_is_disable_for_demo'));
            return back();
        }
        $config = SystemSetting::where(['key' => 'mail_config'])->first();

        $data = $config ? json_decode($config['value'], true) : null;

        SystemSetting::updateOrInsert(
            ['key' => 'mail_config'],
            [
                'value' => json_encode([
                    "status" => $request['status'] ?? 0,
                    "name" => $data['name'] ?? '',
                    "host" => $data['host'] ?? '',
                    "driver" => $data['driver'] ?? '',
                    "port" => $data['port'] ?? '',
                    "username" => $data['username'] ?? '',
                    "email_id" => $data['email_id'] ?? '',
                    "encryption" => $data['encryption'] ?? '',
                    "password" => $data['password'] ?? ''
                ]),
                'updated_at' => now()
            ]
        );
        Toastr::success(translate('messages.configuration_updated_successfully'));
        return back();
    }

    public function app_settings()
    {
        return view('admin-views.system-settings.app-settings');
    }

    private function update_data($request, $key_data){
        $data = DataSetting::firstOrNew(
            ['key' =>  $key_data,
            'type' =>  'admin_landing_page'],
        );

        $data->value = $request->{$key_data}[array_search('default', $request->lang)];
        $data->save();
        $default_lang = str_replace('_', '-', app()->getLocale());
        foreach ($request->lang as $index => $key) {
            if ($default_lang == $key && !($request->{$key_data}[$index])) {
                if ($key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\DataSetting',
                            'translationable_id' => $data->id,
                            'locale' => $key,
                            'key' => $key_data
                        ],
                        ['value' => $data->value]
                    );
                }
            } else {
                if ($request->{$key_data}[$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\DataSetting',
                            'translationable_id' => $data->id,
                            'locale' => $key,
                            'key' => $key_data
                        ],
                        ['value' => $request->{$key_data}[$index]]
                    );
                }
            }
        }

        return true;
    }

    public function config_setup()
    {
        return view('admin-views.system-settings.config');
    }

    public function config_update(Request $request)
    {
        SystemSetting::query()->updateOrInsert(['key' => 'map_api_key'], [
            'value' => $request['map_api_key']
        ]);

        SystemSetting::query()->updateOrInsert(['key' => 'map_api_key_server'], [
            'value' => $request['map_api_key_server']
        ]);

        Toastr::success(translate('messages.config_data_updated'));
        return back();
    }

    public function toggle_settings($key, $value)
    {
        SystemSetting::query()->updateOrInsert(['key' => $key], [
            'value' => $value
        ]);

        Toastr::success(translate('messages.app_settings_updated'));
        return back();
    }

    //recaptcha
    public function recaptcha_index(Request $request)
    {
        return view('admin-views.system-settings.recaptcha-index');
    }

    public function recaptcha_update(Request $request)
    {
        SystemSetting::query()->updateOrInsert(['key' => 'recaptcha'], [
            'key' => 'recaptcha',
            'value' => json_encode([
                'status' => $request['status'],
                'site_key' => $request['site_key'],
                'secret_key' => $request['secret_key']
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Toastr::success(translate('messages.updated_successfully'));
        return back();
    }

    public function send_mail(Request $request)
    {
        $response_flag = 0;
        $message = 'success';
        try {

            Mail::to($request->email)->send(new \App\Mail\TestEmailSender());
            $response_flag = 1;
        } catch (\Exception $exception) {
            info([$exception->getFile(),$exception->getLine(),$exception->getMessage()]);
            $response_flag = 2;
            $message = $exception->getMessage();
        }
        return response()->json(['success' => $response_flag , 'message' => $message]);
    }

    public function site_direction(Request $request){
        if (env('APP_MODE') == 'demo') {
            session()->put('site_direction', ($request->status == 1?'ltr':'rtl'));
            return response()->json();
        }
        if($request->status == 1){
            SystemSetting::query()->updateOrInsert(['key' => 'site_direction'], [
                'value' => 'ltr'
            ]);
        } else
        {
            SystemSetting::query()->updateOrInsert(['key' => 'site_direction'], [
                'value' => 'rtl'
            ]);
        }
        return ;
    }

    public function email_index(Request $request,$type,$tab)
    {
        $template = $request->query('template',null);
        if ($tab == 'forgot-password') {
            return view('admin-views.system-settings.email-format-setting.'.$type.'-email-formats.forgot-pass-format',compact('template'));
        }
    }

    public function update_email_index(Request $request,$type,$tab)
    {
        if (env('APP_MODE') == 'demo') {
            Toastr::info(translate('messages.update_option_is_disable_for_demo'));
            return back();
        }
        if($tab == 'forget-password'){
            $email_type = 'forget_password';
            $template = EmailTemplate::where('type',$type)->where('email_type', 'forget_password')->first();
        }
        if ($template == null) {
            $template = new EmailTemplate();
        }

        $template->title = $request->title[array_search('default', $request->lang)];
        $template->body = $request->body[array_search('default', $request->lang)];
        $template->button_name = $request->button_name?$request->button_name[array_search('default', $request->lang)]:'';
        $template->footer_text = $request->footer_text[array_search('default', $request->lang)];
        $template->copyright_text = $request->copyright_text[array_search('default', $request->lang)];
        $template->background_image = $request->has('background_image') ? Helpers::update('email_template/', $template->background_image, 'png', $request->file('background_image')) : $template->background_image;
        $template->image = $request->has('image') ? Helpers::update('email_template/', $template->image, 'png', $request->file('image')) : $template->image;
        $template->logo = $request->has('logo') ? Helpers::update('email_template/', $template->logo, 'png', $request->file('logo')) : $template->logo;
        $template->icon = $request->has('icon') ? Helpers::update('email_template/', $template->icon, 'png', $request->file('icon')) : $template->icon;
        $template->email_type = $email_type;
        $template->type = $type;
        $template->button_url = $request->button_url??'';
        $template->email_template = $request->email_template;
        $template->save();
        $default_lang = str_replace('_', '-', app()->getLocale());
        foreach ($request->lang as $index => $key) {
            if ($default_lang == $key && !($request->title[$index])) {
                if ($key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\EmailTemplate',
                            'translationable_id'    => $template->id,
                            'locale'                => $key,
                            'key'                   => 'title'
                        ],
                        ['value'                 => $template->title]
                    );
                }
            } else {

                if ($request->title[$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\EmailTemplate',
                            'translationable_id'    => $template->id,
                            'locale'                => $key,
                            'key'                   => 'title'
                        ],
                        ['value'                 => $request->title[$index]]
                    );
                }
            }
            if ($default_lang == $key && !($request->body[$index])) {
                if ($key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\EmailTemplate',
                            'translationable_id'    => $template->id,
                            'locale'                => $key,
                            'key'                   => 'body'
                        ],
                        ['value'                 => $template->body]
                    );
                }
            } else {

                if ($request->body[$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\EmailTemplate',
                            'translationable_id'    => $template->id,
                            'locale'                => $key,
                            'key'                   => 'body'
                        ],
                        ['value'                 => $request->body[$index]]
                    );
                }
            }

            if ($request?->body_2 && $default_lang == $key && !($request->body_2[$index])) {
                if ($key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\EmailTemplate',
                            'translationable_id'    => $template->id,
                            'locale'                => $key,
                            'key'                   => 'body_2'
                        ],
                        ['value'                 => $template->body_2]
                    );
                }
            } else {

                if ($request?->body_2 && $request->body_2[$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\EmailTemplate',
                            'translationable_id'    => $template->id,
                            'locale'                => $key,
                            'key'                   => 'body_2'
                        ],
                        ['value'                 => $request->body_2[$index]]
                    );
                }
            }
            if ($default_lang == $key && !($request->button_name && $request->button_name[$index])) {
                if ($key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\EmailTemplate',
                            'translationable_id'    => $template->id,
                            'locale'                => $key,
                            'key'                   => 'button_name'
                        ],
                        ['value'                 => $template->button_name]
                    );
                }
            } else {

                if ($request->button_name && $request->button_name[$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\EmailTemplate',
                            'translationable_id'    => $template->id,
                            'locale'                => $key,
                            'key'                   => 'button_name'
                        ],
                        ['value'                 => $request->button_name[$index]]
                    );
                }
            }
            if ($default_lang == $key && !($request->footer_text[$index])) {
                if ($key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\EmailTemplate',
                            'translationable_id'    => $template->id,
                            'locale'                => $key,
                            'key'                   => 'footer_text'
                        ],
                        ['value'                 => $template->footer_text]
                    );
                }
            } else {

                if ($request->footer_text[$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\EmailTemplate',
                            'translationable_id'    => $template->id,
                            'locale'                => $key,
                            'key'                   => 'footer_text'
                        ],
                        ['value'                 => $request->footer_text[$index]]
                    );
                }
            }
            if ($default_lang == $key && !($request->copyright_text[$index])) {
                if ($key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\EmailTemplate',
                            'translationable_id'    => $template->id,
                            'locale'                => $key,
                            'key'                   => 'copyright_text'
                        ],
                        ['value'                 => $template->copyright_text]
                    );
                }
            } else {

                if ($request->copyright_text[$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\EmailTemplate',
                            'translationable_id'    => $template->id,
                            'locale'                => $key,
                            'key'                   => 'copyright_text'
                        ],
                        ['value'                 => $request->copyright_text[$index]]
                    );
                }
            }
        }

        Toastr::success(translate('messages.template_added_successfully'));
        return back();
    }

    public function update_email_status(Request $request,$type,$tab,$status)
    {
        if (env('APP_MODE') == 'demo') {
            Toastr::info(translate('messages.update_option_is_disable_for_demo'));
            return back();
        }

        if ($tab == 'forgot-password') {
            SystemSetting::query()->updateOrInsert(['key' => 'forget_password_mail_status_'.$type], [
                'value' => $status
            ]);
        }
        Toastr::success(translate('messages.email_status_updated'));
        return back();

    }

    public function login_url_page(){
        $data=array_column(DataSetting::whereIn('key',['admin_login_url'
                ])->get(['key','value'])->toArray(), 'value', 'key');

        return view('admin-views.login-setup.login_setup',compact('data'));
    }

    public function login_url_page_update(Request $request){

        $request->validate([
            'type' => 'required',
            'admin_login_url' => 'nullable|regex:/^[a-zA-Z0-9\-\_]+$/u|unique:data_settings,value',
        ]);

        if($request->type == 'admin') {
            DataSetting::query()->updateOrInsert(['key' => 'admin_login_url','type' => 'login_admin'], [
                'value' => $request->admin_login_url
            ]);
        }
        Toastr::success(translate('messages.update_successfull'));
        return back();
    }


    public function remove_image(Request $request){

    $request->validate([
        'model_name' => 'required',
        'id' => 'required',
        'image_path' => 'required',
        'field_name' => 'required',
    ]);
    try {

        $model_name = $request->model_name;
        $model = app("\\App\\Models\\{$model_name}");
        $data=  $model->where('id', $request->id)->first();

        $data_value = $data?->{$request->field_name};
        if (!$data_value){
            $data_value = json_decode($data?->value, true);
        }

                if($request?->json == 1){
                    Helpers::check_and_delete($request->image_path.'/' , $data_value[$request->field_name]);
                    $data_value[$request->field_name] = null;
                    $data->value = json_encode($data_value);
                }
                else{
                    Helpers::check_and_delete($request->image_path.'/' , $data_value);
                    $data->{$request->field_name} = null;
                }

        $data?->save();

    } catch (\Throwable $th) {
        Toastr::error($th->getMessage(). 'Line....'.$th->getLine());
        return back();
    }
        Toastr::success(translate('messages.Image_removed_successfully'));
        return back();
    }

    public function about()
    {
        $about = DataSetting::withoutGlobalScope('translate')->where('type', 'admin_landing_page')->where('key', 'about')->first();
        $about_image = DataSetting::where('type', 'admin_landing_page')->where('key', 'about_image')->first();
        return view('admin-views.system-settings.about', compact('about', 'about_image'));
    }

    public function about_update(Request $request)
    {        
        $request->validate([
            'about_image' => 'nullable|max:60000'
        ]);

        $old_image = DataSetting::withoutGlobalScope('translate')->where('type', 'admin_landing_page')->where('key', 'about_image')->first();
        if($request->hasFile('about_image')){
            if(!empty($old_image)){
                Helpers::check_and_delete('about/', $old_image);
            }
            $image_name = Helpers::update(dir: 'about/', old_image: null, format: 'png', image: $request->file('about_image'));

            DataSetting::query()->updateOrInsert(['key' => 'about_image'], [
                'value' => $image_name
            ]);
        } else {
            $image_name = $old_image;
        }
        $this->update_data($request, 'about');
        Toastr::success(translate('messages.about_updated'));
        return back();
    }
    
}
