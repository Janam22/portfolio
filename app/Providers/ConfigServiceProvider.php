<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Setting;
use App\Models\DataSetting;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use App\CentralLogics\Helpers;
Carbon::setWeekStartsAt(Carbon::MONDAY);
Carbon::setWeekEndsAt(Carbon::SUNDAY);
class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $mode = env('APP_MODE');

        try {
            $data = SystemSetting::where(['key' => 'mail_config'])->first();
            $emailServices = json_decode($data['value'], true);
            if ($emailServices) {
                $config = array(
                    'status' => (Boolean)(isset($emailServices['status'])?$emailServices['status']:1),
                    'driver' => $emailServices['driver'],
                    'host' => $emailServices['host'],
                    'port' => $emailServices['port'],
                    'username' => $emailServices['username'],
                    'password' => $emailServices['password'],
                    'encryption' => $emailServices['encryption'],
                    'from' => array('address' => $emailServices['email_id'], 'name' => $emailServices['name']),
                    'sendmail' => '/usr/sbin/sendmail -bs',
                    'pretend' => false,
                );
                Config::set('mail', $config);
            }

            $pagination = SystemSetting::where(['key' => 'default_pagination'])->first();
            if ($pagination) {
                Config::set('default_pagination', $pagination->value);
            } else {
                Config::set('default_pagination', 25);
            }

            $round_up_to_digit = SystemSetting::where(['key' => 'digit_after_decimal_point'])->first();
            if ($round_up_to_digit) {
                Config::set('round_up_to_digit', $round_up_to_digit->value);
            } else {
                Config::set('round_up_to_digit', 2);
            }

            $timezone = SystemSetting::where(['key' => 'timezone'])->first();
            if ($timezone) {
                Config::set('timezone', $timezone->value);
                date_default_timezone_set($timezone->value);
            }

            $timeformat = SystemSetting::where(['key' => 'timeformat'])->first();
            if ($timeformat && $timeformat->value == '12') {
                Config::set('timeformat', 'h:i a');
            }
            else{
                Config::set('timeformat', 'H:i');
            }

            $data = SystemSetting::where(['key' => 's3_credential'])->first();

            $credentials= null;
            if($data?->value){
                $credentials = json_decode($data['value'], true);
            }

            $config = (boolean)systemSetting::where(['key' => 'local_storage'])->first()?->value;
            if ($credentials) {
                Config::set('filesystems.default', $config ? ($config == 0 ? 's3' : 'local') : 'local');
                Config::set('filesystems.disks.s3.key', $credentials['key']);
                Config::set('filesystems.disks.s3.secret', $credentials['secret']);
                Config::set('filesystems.disks.s3.region', $credentials['region']);
                Config::set('filesystems.disks.s3.bucket', $credentials['bucket']);
                Config::set('filesystems.disks.s3.url', $credentials['url']);
                Config::set('filesystems.disks.s3.endpoint', $credentials['end_point']);
            }

            if(Cache::has('maintenance')){
                $maintenance = Cache::get('maintenance');
                    if (isset($maintenance['maintenance_duration']) && $maintenance['maintenance_duration'] != 'until_change' && isset($maintenance['start_date']) && isset($maintenance['end_date'])) {
                        $start = Carbon::parse($maintenance['start_date']);
                        $end = Carbon::parse($maintenance['end_date']);
                        $today = Carbon::now();
                            if ($today->gt($end)) {
                                Cache::forget('maintenance');
                                $maintenance_mode = SystemSetting::firstOrNew(['key' => 'maintenance_mode']);
                                $maintenance_mode->value= 0;
                                $maintenance_mode->save();


                                $maintenance_mode_data=  DataSetting::where('type','maintenance_mode')->whereIn('key' ,['maintenance_system_setup'])->pluck('value','key')
                                ->map(function ($value) {
                                    return json_decode($value, true);
                                })
                                ->toArray();


                                $systemTopicMap = [
                                    'user_mobile_app' => 'maintenance_mode_user_app',
                                    'professionalman_app' => 'maintenance_mode_professionalman_app',
                                ];
                                $notification=[
                                    'title' => translate('We_are_back'),
                                    'description' => translate('Maintenance mode is removed'),
                                    'image' => '',
                                    'order_id' => '',
                                ];

                                foreach ($systemTopicMap as $system => $topic) {
                                    if (in_array($system, data_get($maintenance_mode_data,'maintenance_system_setup',[]))) {
                                        Helpers::send_push_notif_for_maintenance_mode($notification, $topic, 'maintenance');
                                    }
                                }


                                }
                        }
                }

        } catch (\Exception $exception) {
            info([$exception->getFile(),$exception->getLine(),$exception->getMessage()]);
        }
    }
}
