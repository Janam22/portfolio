<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\DataSetting;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CentralLogics\Helpers;

class SettingController extends Controller
{
    public function get_settings_data(Request $request)
    {
        $datas =  DataSetting::with('translations')->where('type','admin_landing_page')->get();
        $data = [];
        foreach ($datas as $key => $value) {
            if(count($value->translations)>0){
                $cred = [
                    $value->key => $value->translations[0]['value'],
                ];
                array_push($data,$cred);
            }else{
                $cred = [
                    $value->key => $value->value,
                ];
                array_push($data,$cred);
            }
            if(count($value->storage)>0){
                $cred = [
                    $value->key.'_storage' => $value->storage[0]['value'],
                ];
                array_push($data,$cred);
            }else{
                $cred = [
                    $value->key.'_storage' => 'public',
                ];
                array_push($data,$cred);
            }
        }
        $settings = [];
        foreach($data as $single_data){
            foreach($single_data as $key=>$single_value){
                $settings[$key] = $single_value;
            }
        }

        $key=['system_name', 'logo', 'phone', 'email_address', 'address', 'footer_text', 'icon', 'client_count', 'project_count', 'service_count'];
        $system_settings =  SystemSetting::whereIn('key', $key)->pluck('value','key')->toArray();

        $landing_data = [
            'about_me'=>   $settings['about'] ?? null ,
            'about_me_image_full_url'=>   Helpers::get_full_url('about',$settings['about_image'] ??  null,$settings['about_image']),

            'system_name' =>  $system_settings['system_name'] ?? 'Janam Pandey Portfolio',
            'system_logo'=>   Helpers::get_full_url('system',$system_settings['logo'] ??  null,$system_settings['logo']),
            'phone' =>  $system_settings['phone'] ?? '+977-9866077949',
            'email_address' =>  $system_settings['email_address'] ?? 'jananpandey1995@gmail.com',
            'address' =>  $system_settings['address'] ?? 'Kathmandu',
            'footer_text' =>  $system_settings['footer_text'] ?? 'All Right Reserved',
            'system_icon'=>   Helpers::get_full_url('system',$system_settings['icon'] ??  null,$system_settings['icon']),
            'client_count' =>  $system_settings['client_count'] ?? '5',
            'project_count' =>  $system_settings['project_count'] ?? '10',
            'service_count' =>  $system_settings['service_count'] ?? '5',

        ];

        try {
            return response()->json(['landing_data'=>$landing_data], 200);
        } catch (\Exception $e) {
            info($e->getMessage());
            return response()->json([], 200);
        }
    }

}
