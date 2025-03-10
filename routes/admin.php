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

        Route::group(['prefix' => 'custom-role', 'as' => 'custom-role.', 'middleware' => ['module:custom_role']], function () {
            Route::get('create', 'CustomRoleController@create')->name('create');
            Route::post('create', 'CustomRoleController@store');
            Route::get('edit/{id}', 'CustomRoleController@edit')->name('edit');
            Route::post('update/{id}', 'CustomRoleController@update')->name('update');
            Route::delete('delete/{id}', 'CustomRoleController@distroy')->name('delete');
            Route::post('search', 'CustomRoleController@search')->name('search');
            Route::get('export-employee-role', 'CustomRoleController@employee_role_export')->name('export-employee-role');
        });

        Route::group(['prefix' => 'employee', 'as' => 'employee.', 'middleware' => ['module:employee']], function () {
            Route::get('add-new', 'EmployeeController@add_new')->name('add-new');
            Route::post('add-new', 'EmployeeController@store');
            Route::get('list', 'EmployeeController@list')->name('list');
            Route::get('update/{id}', 'EmployeeController@edit')->name('edit');
            Route::post('update/{id}', 'EmployeeController@update')->name('update');            
            Route::get('status/{id}/{status}', 'EmployeeController@status')->name('status');
            Route::delete('delete/{id}', 'EmployeeController@destroy')->name('delete');
            Route::get('export-employee', 'EmployeeController@employee_list_export')->name('export-employee');
        });
        
        Route::group(['prefix' => 'attendance', 'as' => 'attendance.', 'middleware' => ['module:attendance']], function () {
            Route::post('check-in', 'AttendanceController@check_in')->name('checkin');
            Route::post('check-out', 'AttendanceController@check_out')->name('checkout');
            Route::get('export', 'AttendanceController@export')->name('export');
        });
        
        Route::group(['prefix' => 'timesheet', 'as' => 'timesheet.', 'middleware' => ['module:timesheet']], function () {
            Route::get('timesheets', 'TimesheetController@list')->name('list');
            Route::get('add-timesheet', 'TimesheetController@new')->name('new');
            Route::post('timesheet-store', 'TimesheetController@store')->name('store');  
            Route::get('my-timesheets', 'TimesheetController@my_timesheet')->name('my-timesheets');
            Route::get('timesheet-details/{id}', 'TimesheetController@details')->name('details');
            Route::get('export', 'TimesheetController@export')->name('export');
            Route::get('/download/{file_name}/{storage?}', 'TimesheetController@download')->name('download');
        });
        
        Route::group(['prefix' => 'leave', 'as' => 'leave-request.', 'middleware' => ['module:leave']], function () {
            Route::get('leave-requests', 'LeaveController@list')->name('list');
            Route::get('leave-request-new', 'LeaveController@request')->name('request');
            Route::post('leave-request-store', 'LeaveController@store')->name('store');  
            Route::post('status/{id}/{leave_status}', 'LeaveController@status')->name('status');
            Route::get('my-leave-requests', 'LeaveController@my_request')->name('my-requests');
            Route::get('export', 'LeaveController@export')->name('export');
        });
        
        Route::group(['prefix' => 'travel-order', 'as' => 'travel-order-request.', 'middleware' => ['module:travelorder']], function () {
            Route::get('travel-order-requests', 'TravelOrderController@list')->name('list');
            Route::get('travel-order-request-new', 'TravelOrderController@request')->name('request');
            Route::post('travel-order-request-store', 'TravelOrderController@store')->name('store');  
            Route::post('status/{id}/{travel_order_status}', 'TravelOrderController@status')->name('status');
            Route::get('my-travel-order-requests', 'TravelOrderController@my_request')->name('my-requests');
            Route::get('export', 'TravelOrderController@export')->name('export');
        });
        
        Route::group(['prefix' => 'staff-attendance', 'as' => 'staff-attendance.', 'middleware' => ['module:staff_attendance']], function () {
            Route::get('list', 'AttendanceController@list')->name('list');
        });

        Route::group(['prefix' => 'business-settings', 'as' => 'business-settings.', 'middleware' => ['module:settings', 'actch']], function () {
            Route::post('update-landing-setup', 'BusinessSettingsController@landing_page_settings_update')->name('business-setup.update-landing-setup');
            Route::delete('delete-custom-landing-page', 'BusinessSettingsController@delete_custom_landing_page')->name('business-setup.delete-custom-landing-page');

            Route::get('business-setup/{tab?}', 'BusinessSettingsController@business_index')->name('business-setup');
            Route::post('update-dm', 'BusinessSettingsController@update_dm')->name('update-dm');
            Route::post('update-order', 'BusinessSettingsController@update_order')->name('update-order');
            Route::post('update-priority', 'BusinessSettingsController@update_priority')->name('update-priority');
            Route::get('config-setup', 'BusinessSettingsController@config_setup')->name('config-setup');
            Route::post('config-update', 'BusinessSettingsController@config_update')->name('config-update');
            Route::post('update-setup', 'BusinessSettingsController@business_setup')->name('update-setup');
            Route::get('theme-settings', 'BusinessSettingsController@theme_settings')->name('theme-settings');
            Route::POST('theme-settings-update', 'BusinessSettingsController@update_theme_settings')->name('theme-settings-update');
            Route::get('app-settings', 'BusinessSettingsController@app_settings')->name('app-settings');
            Route::POST('app-settings', 'BusinessSettingsController@update_app_settings')->name('app-settings');
            Route::get('notification-setup', 'BusinessSettingsController@notification_setup')->name('notification_setup');
            Route::get('notification-status-change/{key}/{user_type}/{type}', 'BusinessSettingsController@notification_status_change')->name('notification_status_change');

            Route::get('toggle-settings/{key}/{value}', 'BusinessSettingsController@toggle_settings')->name('toggle-settings');

            Route::get('mail-config', 'BusinessSettingsController@mail_index')->name('mail-config');
            Route::post('mail-config', 'BusinessSettingsController@mail_config');
            Route::post('mail-config-status', 'BusinessSettingsController@mail_config_status')->name('mail-config-status');
            Route::get('send-mail', 'BusinessSettingsController@send_mail')->name('mail.send');

            //recaptcha
            Route::get('recaptcha', 'BusinessSettingsController@recaptcha_index')->name('recaptcha_index');
            Route::post('recaptcha-update', 'BusinessSettingsController@recaptcha_update')->name('recaptcha_update');
            
            Route::get('site_direction', 'BusinessSettingsController@site_direction')->name('site_direction');

            Route::get('email-setup/{type}/{tab?}', 'BusinessSettingsController@email_index')->name('email-setup');
            Route::POST('email-setup/{type}/{tab?}', 'BusinessSettingsController@update_email_index')->name('email-setup');
            Route::get('email-status/{type}/{tab}/{status}', 'BusinessSettingsController@update_email_status')->name('email-status');
        });

        Route::group(['prefix' => 'business-settings', 'as' => 'language.','middleware' => ['module:settings']], function () {
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

        Route::group(['prefix' => 'login-url', 'as' => 'login_url.', 'middleware' => ['module:settings']], function () {
            Route::get('login-page-setup', 'BusinessSettingsController@login_url_page')->name('login_url_page');
            Route::post('login-page-setup/update', 'BusinessSettingsController@login_url_page_update')->name('login_url_page_update');
        });

        Route::post('remove_image', 'BusinessSettingsController@remove_image')->name('remove_image');

    });
});

