<?php

//echo "string";die;
Route::get('country', 'CountryController@index')->name('admin.country');
Route::get('country/create', 'CountryController@create')->name('admin.country.create');
Route::post('country/store', 'CountryController@store')->name('admin.country.store');
//Route::resource('articles', 'ArticleController');
Route::get('country/edit/{id}', 'CountryController@edit')->name('admin.country.edit');
Route::post('country/update', 'CountryController@update')->name('admin.country.update');
Route::post('country/delete', 'CountryController@delete')->name('admin.country.delete');


/*Route::get('state', 'StateController@index')->name('admin.state');
Route::post('state/store', 'StateController@putUpdateUser')->name('admin.state.store');*/