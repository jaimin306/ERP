<?php

//echo "string";die;
Route::get('designation', 'DesignationController@index')->name('admin.designation');
Route::get('designation/create', 'DesignationController@create')->name('admin.designation.create');
Route::post('designation/store', 'DesignationController@store')->name('admin.designation.store');
//Route::resource('articles', 'ArticleController');
Route::get('designation/edit/{id}', 'DesignationController@edit')->name('admin.designation.edit');
Route::post('designation/update', 'DesignationController@update')->name('admin.designation.update');
Route::post('designation/delete', 'DesignationController@delete')->name('admin.designation.delete');


/*Route::get('state', 'DesignationController@index')->name('admin.state');
Route::post('state/store', 'DesignationController@putUpdateUser')->name('admin.state.store');*/