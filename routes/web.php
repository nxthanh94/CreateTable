<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//////////////////////////////////////////////////////////////////
//Quản lý admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware' => 'auth','middleware' =>'role'], function () {
	Route::get('',[
		'uses' => 'IndexController@index',
		'as'  => 'admin.index.index'
	]);

	//Quản lý tin tức
	Route::group(['prefix' => 'tin-tuc'], function () {
		Route::get('',[
			'uses' => 'NewsController@index',
			'as'  => 'admin.news.index'
		]);

		Route::get('chi-tiet/{id}',[
			'uses' => 'NewsController@chitiet',
			'as'  => 'admin.news.chitiet'
		]);

		Route::get('add',[
			'uses' => 'NewsController@getadd',
			'as'  => 'admin.news.add'
		]);

		Route::post('add',[
			'uses' => 'NewsController@postadd',
			'as'  => 'admin.news.add'
		]);

		Route::get('edit/{id}',[
			'uses' => 'NewsController@getedit',
			'as'  => 'admin.news.edit'
		]);

		Route::post('edit/{id}',[
			'uses' => 'NewsController@postedit',
			'as'  => 'admin.news.edit'
		]);

		Route::get('/del/{id}',[
			'uses' => 'NewsController@del',
			'as'  => 'admin.news.del'
		]);
	});

	//Quản lý users
	Route::group(['prefix' => 'nguoi-dung'], function () {
		Route::get('',[
			'uses' => 'UsersController@index',
			'as'  => 'admin.users.index'
		]);

		Route::get('add',[
			'uses' => 'UsersController@getadd',
			'as'  => 'admin.users.add'
		]);

		Route::post('add',[
			'uses' => 'UsersController@postadd',
			'as'  => 'admin.users.add'
		]);

		Route::get('edit/{id}',[
			'uses' => 'UsersController@getedit',
			'as'  => 'admin.users.edit'
		]);

		Route::post('edit/{id}',[
			'uses' => 'UsersController@postedit',
			'as'  => 'admin.users.edit'
		]);

		Route::get('del/{id}',[
			'uses' => 'UsersController@del',
			'as' => 'admin.users.del'
		])->middleware('role1');
	});

	
});

Route::group(['namespace' => 'Auth','prefix' => 'auth'], function () {
	Route::get('login',[
		'uses'=> 'AuthController@getLogin',
		'as' => 'public.auth.login'
	]);

	Route::post('login',[
		'uses'=> 'AuthController@postLogin',
		'as' => 'public.auth.login'
	]);

	Route::get('logout',[
		'uses'=> 'AuthController@logout',
		'as' => 'public.auth.logout'
	]);

});
