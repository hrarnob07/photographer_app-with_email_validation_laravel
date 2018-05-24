<?php



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verifyEmailFirst','Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifyToken}','Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::get('/uploadphoto','PhotoController@create');
Route::post('/addphoto','PhotoController@store');
Route::get('/myphoto','PhotoController@index');
Route::get('/catagory','CategoryController@category');
Route::post('/addcategory','CategoryController@addcategory');

Route::post('/addphoto','hotoController@store');

