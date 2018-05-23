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
Route::pattern('id','([0-9]*)');
Route::pattern('slug','(.*)');
Route::get('/', function () {
    return view('welcome');
});
Route::get('',[
	'uses'	=>'IndexController@index',
	'as'	=>'index'
]);
Route::get('login',[
	'uses'	=>'LoginController@index',
	'as'	=>'login'
]);
Route::post('login/checked',[
	'uses'	=>'LoginController@checklogin',
	'as'	=>'login.check'
]);
Route::group(['prefix' => 'dich-vu'], function () {
	Route::get('{slug}-{id}',[
		'uses'	=>'ServiceController@getid',
		'as'	=>'service.getid'
	]);
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
		route::post('change-value-ajax',[
			'uses' => 'ProcessController@changevalueajax',
			'as'  => 'admin.process.changevalueajax'
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
	//Quản news newsservice
	Route::group(['prefix'=>'news-service'], function(){
		Route::get('',[
			'uses'=>'NewsserviceController@index',
			'as'=>'admin.newsservice.index'
		]);
		Route::get('add',[
			'uses'=>'NewsserviceController@getadd',
			'as'=>'admin.newsservice.add'
		]);

		Route::post('add',[
			'uses'=>'NewsserviceController@postadd',
			'as'=>'admin.newsservice.add'
		]);
		Route::get('edit/{id}',[
			'uses' => 'NewsserviceController@getedit',
			'as'  => 'admin.newsservice.edit'
		]);
		Route::post('edit/{id}',[
			'uses' => 'NewsserviceController@postedit',
			'as'  => 'admin.newsservice.edit'
		]);
		Route::get('/del/{id}',[
			'uses' => 'NewsserviceController@del',
			'as'  => 'admin.newsservice.del'
		]);

	});
	//Quản news newspage
	Route::group(['prefix'=>'news-page'], function(){
		Route::get('',[
			'uses'=>'NewspageController@index',
			'as'=>'admin.newspage.index'
		]);

		Route::get('addtype/{type_news}',[
			'uses'=>'NewspageController@getaddtype',
			'as'=>'admin.newspage.addtype'
		]);
		Route::get('add/{type_news}',[
			'uses'=>'NewspageController@getadd',
			'as'=>'admin.newspage.add'
		]);

		Route::post('add/{type_news}',[
			'uses'=>'NewspageController@postadd',
			'as'=>'admin.newspage.add'
		]);
		Route::get('edit/{id}',[
			'uses' => 'NewspageController@getedit',
			'as'  => 'admin.newspage.edit'
		]);
		Route::post('edit/{id}',[
			'uses' => 'NewspageController@postedit',
			'as'  => 'admin.newspage.edit'
		]);
		Route::get('/del/{id}',[
			'uses' => 'NewsserviceController@del',
			'as'  => 'admin.newspage.del'
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
		route::get('group/{id_table}',[
			'uses'	=>'GroupcollumsController@index',
			'as'	=>'admin.groupcollums.index'
		]);
		route::get('add/{id_table}',[
			'uses'	=>'GroupcollumsController@getadd',
			'as'	=>'admin.groupcollums.add'
		]);
		route::post('add/{id_table}',[
			'uses'	=>'GroupcollumsController@postadd',
			'as'	=>'admin.groupcollums.add'
		]);
		route::get('edit/{id}',[
			'uses'	=>'GroupcollumsController@getedit',
			'as'	=>'admin.groupcollums.edit'
		]);
		route::post('edit/{id}',[
			'uses'	=>'GroupcollumsController@postedit',
			'as'	=>'admin.groupcollums.edit'
		]);
		Route::get('/del/{id}',[
			'uses' => 'GroupcollumsController@del',
			'as'  => 'admin.groupcollums.del'
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
