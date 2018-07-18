<?php

//echo "string";die;
Route::get('vendor', 'VendorController@index')->name('admin.vendor');
Route::get('vendor/create', 'VendorController@create')->name('admin.vendor.create');
Route::post('vendor/store', 'VendorController@store')->name('admin.vendor.store');
//Route::resource('articles', 'ArticleController');
Route::get('vendor/edit/{id}', 'VendorController@edit')->name('admin.vendor.edit');
Route::post('vendor/update', 'VendorController@update')->name('admin.vendor.update');
Route::post('vendor/delete', 'VendorController@delete')->name('admin.vendor.delete');

Route::get('vendor/getState/{id}', 'VendorController@getStates')->name('admin.vendor.getState');
Route::get('vendor/chkEmail/{email}', 'VendorController@chkVendorEmail')->name('admin.vendor.chkEmail');


/*Route::get('state', 'StateController@index')->name('admin.state');
Route::post('state/store', 'StateController@putUpdateUser')->name('admin.state.store');*/