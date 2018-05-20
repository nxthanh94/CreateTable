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
	//Quản lý table
	Route::group(['prefix'=>'table'], function(){
		Route::get('',[
			'uses'=>'TableController@index',
			'as'=>'admin.table.index'
		]);
		Route::get('add-table',[
			'uses'=>'TableController@addtable',
			'as'=>'admin.table.addtable'
		]);

		Route::post('add-table',[
			'uses'=>'TableController@addtable_value',
			'as'=>'admin.table.posttbale'
		]);
		Route::get('edit/{id}',[
			'uses' => 'TableController@getedit',
			'as'  => 'admin.table.edit'
		]);
		Route::post('edit/{id}',[
			'uses' => 'TableController@postedit',
			'as'  => 'admin.table.edit'
		]);
		Route::get('/del/{id}',[
			'uses' => 'TableController@del',
			'as'  => 'admin.table.del'
		]);

	});
	//Quản lý collums
	Route::group(['prefix'=>'collums'], function(){
		route::get('control/{id_table}',[
			'uses'=>'CollumsController@index',
			'as'=>'admin.collums.index'
		]);
		route::get('/add/{id_table}',[
			'uses'=>'CollumsController@addget',
			'as' =>'admin.collums.addget'
		]);

		route::post('/add/{id_table}',[
			'uses'=>'CollumsController@addpost',
			'as' =>'admin.collums.add'
		]);
		route::get('/add-collums/{id_table}',[
			'uses'=>'CollumsController@addcollumsget',
			'as' =>'admin.collums.addcollums'
		]);

		route::post('/add-collums/{id_table}',[
			'uses'=>'CollumsController@addcollumspost',
			'as' =>'admin.collums.addcollums'
		]);
		Route::post('ajax-get-table',[
			'uses' => 'CollumsController@gettable_ajax',
			'as'  => 'admin.collums.ajaxtable'
		]);
		Route::post('change-value',[
			'uses' => 'CollumsController@change_value',
			'as'  => 'admin.collums.ajaxchangevalue'
		]);
		Route::get('/edit/{id}',[
			'uses' => 'CollumsController@getedit',
			'as'  => 'admin.collums.edit'
		]);
		Route::post('/edit/{id}',[
			'uses' => 'CollumsController@postedit',
			'as'  => 'admin.collums.edit'
		]);
		Route::get('/del/{id}',[
			'uses' => 'CollumsController@del',
			'as'  => 'admin.collums.del'
		]);
	});
	//Quảng lý group collom
	Route::group(['prefix' => 'group-collums'], function () {
		route::get('add/{id_table}',[
			'uses'	=>'GroupcollumsController@getadd',
			'as'	=>'admin.groupcollums.add'
		]);
		route::post('add/{id_table}',[
			'uses'	=>'GroupcollumsController@postadd',
			'as'	=>'admin.groupcollums.add'
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
