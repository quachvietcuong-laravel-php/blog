<?php

use Illuminate\Support\Facades\Route;

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

// Admin 

Route::get('/admin-login', 'AdminController@getAdminLogin');
Route::post('/admin-login', 'AdminController@postAdminLogin');

Route::get('/admin-logout', 'AdminController@getAdminLogout');

Route::group(['prefix' => 'admin' , 'middleware' => 'adminLogin'] , function(){
	Route::get('/dashboard' , 'AdminController@getAdminDashboard');

	//category
	Route::group(['prefix' => 'category'] , function(){
		Route::get('/add' , 'CategoryController@getAddCategory');
		Route::post('/add' , 'CategoryController@postAddCategory');

		Route::get('/all' , 'CategoryController@getAllCategory');

		Route::get('/delete/{id}' , 'CategoryController@getDeleteCategory');

		Route::get('/edit/{id}' , 'CategoryController@getEditCategory');
		Route::post('/edit/{id}' , 'CategoryController@postEditCategory');
	});	

	//posts
	Route::group(['prefix' => 'posts'] , function(){
		Route::get('/add' , 'PostsController@getAddPost');
		Route::post('/add' , 'PostsController@postAddPost');

		Route::get('/all' , 'PostsController@getAllPost');

		Route::get('/details/{id}' , 'PostsController@getAllPostDetails');

		Route::get('/details/hide/{id}/{posts_id}' , 'PostsController@getHideCommentPosts');
		Route::get('/details/show/{id}/{posts_id}' , 'PostsController@getShowCommentPosts');

		Route::get('/delete/{id}' , 'PostsController@getDeletePost');

		Route::get('/edit/{id}' , 'PostsController@getEditPost');
		Route::post('/edit/{id}' , 'PostsController@postEditPost');
	});

	//image
	Route::group(['prefix' => 'image'] , function(){
		Route::get('/add' , 'ImageController@getAddImage');
		Route::post('/add' , 'ImageController@postAddImage');

		Route::get('/all' , 'ImageController@getAllImage');

		Route::get('/delete/{id}' , 'ImageController@getDeleteImage');

		Route::get('/edit/{id}' , 'ImageController@getEditImage');
		Route::post('/edit/{id}' , 'ImageController@postEditImage');
	});		
});


// User
