<?php
Route::get('itemCategory', 'ItemCategoryController@index')->name('admin.itemCategory');
Route::get('itemCategory/create', 'ItemCategoryController@create')->name('admin.itemCategory.create');
Route::post('itemCategory/store', 'ItemCategoryController@store')->name('admin.itemCategory.store');
Route::get('itemCategory/edit/{id}', 'ItemCategoryController@edit')->name('admin.itemCategory.edit');
Route::post('itemCategory/update', 'ItemCategoryController@update')->name('admin.itemCategory.update');
Route::post('itemCategory/delete', 'ItemCategoryController@delete')->name('admin.itemCategory.delete');