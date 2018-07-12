<?php

//echo "string";die;
Route::get('setting', 'SettingController@index')->name('admin.setting');
// Route::get('state/create', 'StateController@create')->name('admin.state.create');
// Route::post('state/store', 'StateController@store')->name('admin.state.store');
// //Route::resource('articles', 'ArticleController');
// Route::get('state/edit/{id}', 'StateController@edit')->name('admin.state.edit');
// Route::post('state/update', 'StateController@update')->name('admin.state.update');
// Route::post('state/delete', 'StateController@delete')->name('admin.state.delete');


/*Route::get('state', 'StateController@index')->name('admin.state');
Route::post('state/store', 'StateController@putUpdateUser')->name('admin.state.store');*/