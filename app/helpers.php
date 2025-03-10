<?php

use App\CentralLogics\Helpers;
use App\Models\BusinessSetting;


if (! function_exists('translate')) {
    function translate($key, $replace = [])
    {
        if (strpos($key, 'validation.') === 0 || strpos($key, 'passwords.') === 0 || strpos($key, 'pagination.') === 0 || strpos($key, 'order_texts.') === 0) {
            return trans($key, $replace);
        }

        $key = strpos($key, 'messages.') === 0 ? substr($key, 9) : $key;
        $local = app()->getLocale();
        try {
            $lang_array = include(base_path('resources/lang/' . $local . '/messages.php'));
            $processed_key = ucfirst(str_replace('_', ' ', Helpers::remove_invalid_charcaters($key)));

            if (!array_key_exists($key, $lang_array)) {
                $lang_array[$key] = $processed_key;
                $str = "<?php return " . var_export($lang_array, true) . ";";
                file_put_contents(base_path('resources/lang/' . $local . '/messages.php'), $str);
                $result = $processed_key;
            } else {
                $result = trans('messages.' . $key, $replace);
            }
        } catch (\Exception $exception) {
            info([$exception->getFile(), $exception->getLine(), $exception->getMessage()]);
            $result = trans('messages.' . $key, $replace);
        }

        return $result;
    }
}

if (! function_exists('sub_fail')) {
    function sub_fail($data)
    {
        return true;
    }
}

if (!function_exists('addon_published_status')) {
    function addon_published_status($module_name)
    {
        $is_published = 0;
        try {
            if(file_exists("Modules/{$module_name}/Addon/info.php")){
                $full_data = include("Modules/{$module_name}/Addon/info.php");
                $is_published = $full_data['is_published'] == 1 ? 1 : 0;
            }
            return $is_published;
        } catch (\Exception $exception) {
            info([$exception->getFile(), $exception->getLine(), $exception->getMessage()]);
            return 0;
        }
    }
}

if (!function_exists('dynamicAsset')) {
    function dynamicAsset(string $directory): string
    {
        if (DOMAIN_POINTED_DIRECTORY == 'public') {
            $result = str_replace('public/', '', $directory);
        } else {
            $result = $directory;
        }
        return asset($result);
    }
}
if (!function_exists('dynamicStorage')) {
    function dynamicStorage(string $directory): string
    {
        if (DOMAIN_POINTED_DIRECTORY == 'public') {
            $result = str_replace('storage/app/public', 'storage', $directory);
        } else {
            $result = $directory;
        }
        return asset($result);
    }
}

if (!function_exists('getWebConfig')) {
    function getWebConfig($name): string|object|array
    {
        $config = null;
        $check = ['currency_model', 'currency_symbol_position', 'system_default_currency', 'language', 'company_name', 'decimal_point_settings', 'product_brand', 'digital_product', 'company_email'];

        if (in_array($name, $check) && session()->has($name)) {
            $config = session($name);
        } else {
            $data = BusinessSetting::where(['key' => $name])->first();
            if (isset($data)) {
                $config = json_decode($data['value'], true);
                if (is_null($config)) {
                    $config = $data['value'];
                }
            }

            if (in_array($name, $check)) {
                session()->put($name, $config);
            }
        }

        return $config;
    }
}
