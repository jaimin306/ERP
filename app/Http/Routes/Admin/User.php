<?php

//echo "string";die;
Route::get('user', 'UserController@index')->name('admin.user');
Route::get('user/create', 'UserController@create')->name('admin.user.create');
Route::post('user/store', 'UserController@store')->name('admin.user.store');
//Route::resource('articles', 'ArticleController');
Route::get('user/edit/{id}', 'UserController@edit')->name('admin.user.edit');
Route::post('user/update', 'UserController@update')->name('admin.user.update');
Route::post('user/delete', 'UserController@delete')->name('admin.user.delete');

Route::get('user/getDesignation/{id}', 'UserController@getDesignation')->name('admin.user.getDesignation');
Route::get('user/chkUserEmail/{email}', 'UserController@chkUserEmail')->name('admin.user.chkUserEmail');


/*Route::get('state', 'StateController@index')->name('admin.state');
Route::post('state/store', 'StateController@putUpdateUser')->name('admin.state.store');*/