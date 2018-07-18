<?php

//echo "string";die;
Route::get('vendorType', 'VendorTypeController@index')->name('admin.vendorType');
Route::get('vendorType/create', 'VendorTypeController@create')->name('admin.vendorType.create');
Route::post('vendorType/store', 'VendorTypeController@store')->name('admin.vendorType.store');
//Route::resource('articles', 'ArticleController');
Route::get('vendorType/edit/{id}', 'VendorTypeController@edit')->name('admin.vendorType.edit');
Route::post('vendorType/update', 'VendorTypeController@update')->name('admin.vendorType.update');
Route::post('vendorType/delete', 'VendorTypeController@delete')->name('admin.vendorType.delete');


/*Route::get('state', 'StateController@index')->name('admin.state');
Route::post('state/store', 'StateController@putUpdateUser')->name('admin.state.store');*/