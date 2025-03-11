<?php
 
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {

    Route::group(['middleware' => ['admin']], function () {
        Route::get('lang/{locale}', 'LanguageController@lang')->name('lang');
        Route::get('settings', 'SystemController@settings')->name('settings');
        Route::post('settings', 'SystemController@settings_update');
        Route::post('settings-password', 'SystemController@settings_password_update')->name('settings-password');

        //dashboard
        Route::get('/', 'DashboardController@dashboard')->name('dashboard');
        Route::get('landing-page', 'SystemController@landing_page')->name('landing-page');

        Route::post('maintenance-mode', 'SystemController@maintenance_mode')->name('maintenance-mode');

        Route::group(['prefix' => 'system-settings', 'as' => 'system-settings.'], function () {
            Route::post('update-landing-setup', 'SystemSettingsController@landing_page_settings_update')->name('system-setup.update-landing-setup');
            Route::delete('delete-custom-landing-page', 'SystemSettingsController@delete_custom_landing_page')->name('system-setup.delete-custom-landing-page');

            Route::get('system-setup/{tab?}', 'SystemSettingsController@system_index')->name('system-setup');
            Route::post('update-dm', 'SystemSettingsController@update_dm')->name('update-dm');
            Route::post('update-order', 'SystemSettingsController@update_order')->name('update-order');
            Route::post('update-priority', 'SystemSettingsController@update_priority')->name('update-priority');
            Route::get('config-setup', 'SystemSettingsController@config_setup')->name('config-setup');
            Route::post('config-update', 'SystemSettingsController@config_update')->name('config-update');
            Route::post('update-setup', 'SystemSettingsController@system_setup')->name('update-setup');
            Route::get('theme-settings', 'SystemSettingsController@theme_settings')->name('theme-settings');
            Route::POST('theme-settings-update', 'SystemSettingsController@update_theme_settings')->name('theme-settings-update');
            Route::get('app-settings', 'SystemSettingsController@app_settings')->name('app-settings');
            Route::POST('app-settings', 'SystemSettingsController@update_app_settings')->name('app-settings');
            Route::get('notification-setup', 'SystemSettingsController@notification_setup')->name('notification_setup');
            Route::get('notification-status-change/{key}/{user_type}/{type}', 'SystemSettingsController@notification_status_change')->name('notification_status_change');

            Route::get('toggle-settings/{key}/{value}', 'SystemSettingsController@toggle_settings')->name('toggle-settings');

            Route::get('mail-config', 'SystemSettingsController@mail_index')->name('mail-config');
            Route::post('mail-config', 'SystemSettingsController@mail_config');
            Route::post('mail-config-status', 'SystemSettingsController@mail_config_status')->name('mail-config-status');
            Route::get('send-mail', 'SystemSettingsController@send_mail')->name('mail.send');

            //recaptcha
            Route::get('recaptcha', 'SystemSettingsController@recaptcha_index')->name('recaptcha_index');
            Route::post('recaptcha-update', 'SystemSettingsController@recaptcha_update')->name('recaptcha_update');
            
            Route::get('site_direction', 'SystemSettingsController@site_direction')->name('site_direction');

            Route::get('email-setup/{type}/{tab?}', 'SystemSettingsController@email_index')->name('email-setup');
            Route::POST('email-setup/{type}/{tab?}', 'SystemSettingsController@update_email_index')->name('email-setup');
            Route::get('email-status/{type}/{tab}/{status}', 'SystemSettingsController@update_email_status')->name('email-status');
            
            Route::get('social-media/fetch', 'SocialMediaController@fetch')->name('social-media.fetch');
            Route::get('social-media/status-update', 'SocialMediaController@social_media_status_update')->name('social-media.status-update');
            Route::resource('social-media', 'SocialMediaController');
            
            Route::get('pages/about', 'SystemSettingsController@about')->name('about');
            Route::post('pages/about', 'SystemSettingsController@about_update');
        });

        Route::group(['prefix' => 'projects', 'as' => 'project.'], function () {
            Route::get('add', 'ProjectController@index')->name('add');
            Route::post('store', 'ProjectController@store')->name('store');
            Route::get('edit/{id}', 'ProjectController@edit')->name('edit');
            Route::post('update/{id}', 'ProjectController@update')->name('update');
            Route::get('update-priority/{category}', 'ProjectController@update_priority')->name('priority');
            Route::get('status/{id}/{status}', 'ProjectController@status')->name('status');
            Route::delete('delete/{id}', 'ProjectController@delete')->name('delete');
            Route::get('export-projects', 'ProjectController@export_projects')->name('export-projects');
        });
        
        Route::group(['prefix' => 'services', 'as' => 'service.'], function () {
            Route::get('add', 'ServiceController@index')->name('add');
            Route::post('store', 'ServiceController@store')->name('store');
            Route::get('edit/{id}', 'ServiceController@edit')->name('edit');
            Route::post('update/{id}', 'ServiceController@update')->name('update');
            Route::get('update-priority/{category}', 'ServiceController@update_priority')->name('priority');
            Route::get('status/{id}/{status}', 'ServiceController@status')->name('status');
            Route::delete('delete/{id}', 'ServiceController@delete')->name('delete');
            Route::get('export-services', 'ServiceController@export_services')->name('export-services');
        });

        Route::group(['prefix' => 'system-settings', 'as' => 'language.'], function () {
            Route::get('language', 'LanguageController@index')->name('index');
            Route::post('language/add-new', 'LanguageController@store')->name('add-new');
            Route::get('language/update-status', 'LanguageController@update_status')->name('update-status');
            Route::get('language/update-default-status', 'LanguageController@update_default_status')->name('update-default-status');
            Route::post('language/update', 'LanguageController@update')->name('update');
            Route::get('language/translate/{lang}', 'LanguageController@translate')->name('translate');
            Route::post('language/translate-submit/{lang}', 'LanguageController@translate_submit')->name('translate-submit');
            Route::post('language/remove-key/{lang}', 'LanguageController@translate_key_remove')->name('remove-key');
            Route::get('language/delete/{lang}', 'LanguageController@delete')->name('delete');
            Route::any('language/auto-translate/{lang}', 'LanguageController@auto_translate')->name('auto-translate');
            Route::get('language/auto-translate-all/{lang}', 'LanguageController@auto_translate_all')->name('auto_translate_all');
        });

        Route::group(['prefix' => 'login-url', 'as' => 'login_url.'], function () {
            Route::get('login-page-setup', 'SystemSettingsController@login_url_page')->name('login_url_page');
            Route::post('login-page-setup/update', 'SystemSettingsController@login_url_page_update')->name('login_url_page_update');
        });

        Route::post('remove_image', 'SystemSettingsController@remove_image')->name('remove_image');

    });
});

