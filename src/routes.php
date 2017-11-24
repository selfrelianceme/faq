<?php
Route::group(['prefix' => config('adminamazing.path').'/faq', 'middleware' => ['web','CheckAccess']], function() {
	Route::get('/', 'Selfreliance\Faq\FaqController@index')->name('AdminFaq');
	Route::get('/create', 'Selfreliance\Faq\FaqController@create')->name('AdminFaqCreate');
	Route::get('/edit/{id?}', 'Selfreliance\Faq\FaqController@edit')->name('AdminFaqEdit');
	Route::put('/create/{id?}', 'Selfreliance\Faq\FaqController@store')->name('AdminFaqUpdate');
	Route::delete('/{id?}', 'Selfreliance\Faq\FaqController@destroy')->name('AdminFaqDestroy');
});
