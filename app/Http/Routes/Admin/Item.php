<?php

//echo "string";die;
Route::get('item', 'ItemController@index')->name('admin.item');
Route::get('item/create', 'ItemController@create')->name('admin.item.create');
Route::post('item/store', 'ItemController@store')->name('admin.item.store');
Route::get('item/edit/{id}', 'ItemController@edit')->name('admin.item.edit');
Route::post('item/update', 'ItemController@update')->name('admin.item.update');
Route::post('item/delete', 'ItemController@delete')->name('admin.item.delete');
Route::get('item/getType/{id}', 'ItemController@getType')->name('admin.item.getType');

//Route::get('item/getDesignation/{id}', 'ItemController@getDesignation')->name('admin.item.getDesignation');
