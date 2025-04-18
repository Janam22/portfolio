<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // dd($request->is('admin/*'));
        $lang ='en';
        $direction ='ltr';


        try {
            $language = SystemSetting::where('key', 'system_language')->first();
            if($language){
                foreach (json_decode($language->value, true) as $key => $data) {
                    if ($data['default'] == true) {
                        $lang= $data['code'];
                        $direction= $data['direction'];
                    }
                }
            }
        } catch (\Exception $exception) {
            info($exception->getMessage());
        }

        if($request->is('admin*')){
            if (session()->has('local')) {
                App::setLocale(session()->get('local'));
            }
            else{
                session()->put('site_direction', $direction);
                // session()->put('local', $lang);
                App::setLocale($lang);
            }
        }else{
            if (session()->has('landing_local')) {
                App::setLocale(session()->get('landing_local'));
            }else{
                // session()->put('landing_local', 'en');
                // App::setLocale('en');
                session()->put('landing_site_direction', $direction);
                // session()->put('landing_local', $lang);
                    App::setLocale($lang);

            }
        }
        return $next($request);
    }
}
