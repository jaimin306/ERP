<?php

//echo "string";die;
Route::get('itemType', 'ItemTypeController@index')->name('admin.itemType');
Route::get('itemType/create', 'ItemTypeController@create')->name('admin.itemType.create');
Route::post('itemType/store', 'ItemTypeController@store')->name('admin.itemType.store');
//Route::resource('articles', 'ArticleController');
Route::get('itemType/edit/{id}', 'ItemTypeController@edit')->name('admin.itemType.edit');
Route::post('itemType/update', 'ItemTypeController@update')->name('admin.itemType.update');
Route::post('itemType/delete', 'ItemTypeController@delete')->name('admin.itemType.delete');


/*Route::get('state', 'StateController@index')->name('admin.state');
Route::post('state/store', 'StateController@putUpdateUser')->name('admin.state.store');*/