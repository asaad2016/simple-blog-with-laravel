<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('content.login');
});
Route::get('/about', function () {
    return view('content.about');
});
Route::get('/posts','PagesController@posts');
Route::get('/profile','PagesController@profile');
Route::get('/search','PagesController@search');
Route::get('/posts/{post}','PagesController@post');
Route::get('/posts/{id}','PagesController@getpost');
Route::get('/post/edit/{id}','PagesController@edit');
Route::post('/post/update/{id}','PagesController@update');
Route::get('/post/delete/{id}','PagesController@delete');

Route::post('/posts/{id}/store','CommentsController@store');
Route::get('/category/{name}','PagesController@category');
Route::get('/register','RegistrationController@create');
Route::post('/register/','RegistrationController@store');
Route::get('/login','SessionController@create');

Route::post('/login/','SessionController@store');

Route::get('/logout','SessionController@destory');
Route::get('/access-denied','PagesController@accessdenid');

Route::group(['middleware' => "roles",'roles' => 'admin'],function (){
	Route::post('/add-role','PagesController@addrole');
	Route::post('/setting','PagesController@setting');
	Route::get('/admin','PagesController@admin');
});
Route::group(['middleware' => "roles",'roles' => ['editor','admin']],function (){
	Route::get('/edit','PagesController@edit');
	Route::post('/posts/store','PagesController@store');
});
Route::group(['middleware' => "roles",'roles' => ['editor','admin','user']],function (){
	
	Route::get('/stats','PagesController@stats');
	Route::get('/posts/like/{id}','PagesController@like');
	Route::get('/posts/dislike/{id}','PagesController@dislike');

	
});
Route::get('/password','SessionController@cpassword');
Route::post('/confirmpassword','SessionController@confirmpassword');
Route::get('/newpassword','SessionController@updatepassword');
Route::post('/createpassword','SessionController@createpassword');
Route::get('/pagenotfount','PagesController@notfountpage');



/*Route::post('/add-role',[
	'uses'         => 'PagesController@addrole',
	'as'           =>'content.admin',
	'middleware'   =>'roles',
	'roles'        =>'admin'
	]
	);
Route::get('/admin',
	[
	'uses'         => 'PagesController@admin',
	'as'           =>'content.admin',
	'middleware'   =>'roles',
	'roles'        =>'admin'
	]
	);*/

	//Route::get('/pagenotfount',[' as' => 'notfount','uses' => 'PagesController@notfountpage']);