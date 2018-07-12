<?php

//echo "string";die;
Route::get('accountType', 'AccountTypeController@index')->name('admin.accountType');
Route::get('accountType/create', 'AccountTypeController@create')->name('admin.accountType.create');
Route::post('accountType/store', 'AccountTypeController@store')->name('admin.accountType.store');
//Route::resource('articles', 'ArticleController');
Route::get('accountType/edit/{id}', 'AccountTypeController@edit')->name('admin.accountType.edit');
Route::post('accountType/update', 'AccountTypeController@update')->name('admin.accountType.update');
Route::post('accountType/delete', 'AccountTypeController@delete')->name('admin.accountType.delete');


/*Route::get('state', 'StateController@index')->name('admin.state');
Route::post('state/store', 'StateController@putUpdateUser')->name('admin.state.store');*/