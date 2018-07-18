<?php

//echo "string";die;
Route::get('settings', 'SettingsController@index')->name('admin.settings');
Route::get('settings/companySetting', 'SettingsController@companySetting')->name('admin.settings.create');
Route::get('settings/emailSetting', 'SettingsController@emailSetting')->name('admin.settings.emailSetting');
Route::get('settings/systemSetting', 'SettingsController@systemSetting')->name('admin.settings.systemSetting');
Route::get('settings/getStateByCountry/{id}', 'SettingsController@getStateByCountry')->name('admin.settings.getStateByCountry');

Route::post('settings/updateCompanySetting', 'SettingsController@updateCompanySetting')->name('admin.settings.updateCompanySetting');
Route::post('settings/updateEmailSetting', 'SettingsController@updateEmailSetting')->name('admin.settings.updateEmailSetting');
Route::post('settings/updateSystemSetting', 'SettingsController@updateSystemSetting')->name('admin.settings.updateSystemSetting');
// Route::post('settings/delete', 'SettingsController@delete')->name('admin.settings.delete');


/*Route::get('state', 'StateController@index')->name('admin.state');
Route::post('state/store', 'StateController@putUpdateUser')->name('admin.state.store');*/