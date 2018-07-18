<?php

//echo "string";die;
Route::get('bankAccount', 'BankAccountController@index')->name('admin.bankAccount');
Route::get('bankAccount/create', 'BankAccountController@create')->name('admin.bankAccount.create');
Route::post('bankAccount/store', 'BankAccountController@store')->name('admin.bankAccount.store');
//Route::resource('articles', 'ArticleController');
Route::get('bankAccount/edit/{id}', 'BankAccountController@edit')->name('admin.bankAccount.edit');
Route::post('bankAccount/update', 'BankAccountController@update')->name('admin.bankAccount.update');
Route::post('bankAccount/delete', 'BankAccountController@delete')->name('admin.bankAccount.delete');


/*Route::get('state', 'StateController@index')->name('admin.state');
Route::post('state/store', 'StateController@putUpdateUser')->name('admin.state.store');*/