<?php

//echo "string";die;
Route::get('admin/country', 'Country\CountryController@index')->name('admin.country');
Route::get('admin/country/create', 'Country\CountryController@create')->name('admin.country.create');
Route::post('admin/country/store', 'Country\CountryController@store')->name('admin.country.store');
//Route::resource('articles', 'ArticleController');
Route::get('admin/country/edit/{id}', 'Country\CountryController@edit')->name('admin.country.edit');
Route::post('admin/country/update', 'Country\CountryController@update')->name('admin.country.update');
Route::post('admin/country/delete', 'Country\CountryController@delete')->name('admin.country.delete');


/*Route::get('state', 'StateController@index')->name('admin.state');
Route::post('state/store', 'StateController@putUpdateUser')->name('admin.state.store');*/