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

	//Quản lý service
	Route::group(['prefix' => 'service'], function () {
		Route::get('',[
			'uses' => 'ServiceController@index',
			'as'  => 'admin.service.index'
		]);

		Route::get('add',[
			'uses' => 'ServiceController@getadd',
			'as'  => 'admin.service.add'
		]);

		Route::post('add',[
			'uses' => 'ServiceController@postadd',
			'as'  => 'admin.service.add'
		]);

		Route::get('edit/{id}',[
			'uses' => 'ServiceController@getedit',
			'as'  => 'admin.service.edit'
		]);

		Route::post('edit/{id}',[
			'uses' => 'ServiceController@postedit',
			'as'  => 'admin.service.edit'
		]);

		Route::get('/del/{id}',[
			'uses' => 'ServiceController@del',
			'as'  => 'admin.service.del'
		]);
	});

	//Quản lý process
	Route::group(['prefix' => 'process'], function () {
		Route::get('',[
			'uses' => 'ProcessController@index',
			'as'  => 'admin.process.index'
		]);

		Route::get('add',[
			'uses' => 'ProcessController@getadd',
			'as'  => 'admin.process.add'
		]);

		Route::post('add',[
			'uses' => 'ProcessController@postadd',
			'as'  => 'admin.process.add'
		]);

		Route::get('edit/{id}',[
			'uses' => 'ProcessController@getedit',
			'as'  => 'admin.process.edit'
		]);

		Route::post('edit/{id}',[
			'uses' => 'ProcessController@postedit',
			'as'  => 'admin.process.edit'
		]);

		Route::get('/del/{id}',[
			'uses' => 'ProcessController@del',
			'as'  => 'admin.process.del'
		]);
	});

	//Quản lý users
	Route::group(['prefix' => 'nguoi-dung'], function () {
		Route::get('',[
			'uses' => 'UsersController@index',
			'as'  => 'admin.user.index'
		]);

		Route::get('add',[
			'uses' => 'UsersController@getadd',
			'as'  => 'admin.user.add'
		]);

		Route::post('add',[
			'uses' => 'UsersController@postadd',
			'as'  => 'admin.user.add'
		]);

		Route::get('edit/{id}',[
			'uses' => 'UsersController@getedit',
			'as'  => 'admin.user.edit'
		]);

		Route::post('edit/{id}',[
			'uses' => 'UsersController@postedit',
			'as'  => 'admin.user.edit'
		]);

		Route::get('del/{id}',[
			'uses' => 'UsersController@del',
			'as' => 'admin.user.del'
		])->middleware('role1');
	});

	//Quản lý service
	Route::group(['prefix' => 'level'], function () {
		Route::get('',[
			'uses' => 'LevelController@index',
			'as'  => 'admin.level.index'
		]);

		Route::get('add',[
			'uses' => 'LevelController@getadd',
			'as'  => 'admin.level.add'
		]);

		Route::post('add',[
			'uses' => 'LevelController@postadd',
			'as'  => 'admin.level.add'
		]);

		Route::get('edit/{id}',[
			'uses' => 'LevelController@getedit',
			'as'  => 'admin.level.edit'
		]);

		Route::post('edit/{id}',[
			'uses' => 'LevelController@postedit',
			'as'  => 'admin.level.edit'
		]);

		Route::get('/del/{id}',[
			'uses' => 'LevelController@del',
			'as'  => 'admin.level.del'
		]);
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
