<?php

//echo "string";die;
Route::get('department', 'DepartmentController@index')->name('admin.department');
Route::get('department/create', 'DepartmentController@create')->name('admin.department.create');
Route::post('department/store', 'DepartmentController@store')->name('admin.department.store');
//Route::resource('articles', 'ArticleController');
Route::get('department/edit/{id}', 'DepartmentController@edit')->name('admin.department.edit');
Route::post('department/update', 'DepartmentController@update')->name('admin.department.update');
Route::post('department/delete', 'DepartmentController@delete')->name('admin.department.delete');


/*Route::get('state', 'StateController@index')->name('admin.state');
Route::post('state/store', 'StateController@putUpdateUser')->name('admin.state.store');*/