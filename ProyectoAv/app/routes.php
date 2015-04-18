<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
// Route::get('products',array('as'=>'products','uses'=>'ProductController@products'));
Route::get('getCPT',array('as'=>'categories','uses'=>'CategoryController@categories'));
Route::get('getListProduct/{idcategory}',array('as'=>'getListProduct','uses'=>'ProductController@getListProduct'));
Route::get('getUsers',array('as'=>'users','uses'=>''));

// create fields
Route::post('newUser',array('as'=>'newUser','uses'=>'CreateController@newUser'));
Route::post('newCategory',array('as'=>'newCategory','uses'=>'CreateController@newCategory'));
Route::post('newProduct',array('as'=>'newProduct','uses'=>'CreateController@newProduct'));
Route::post('newEstimation',array('as'=>'newEstimation','uses'=>'CreateController@newEstimation'));
Route::post('newType',array('as'=>'newType','uses'=>'CreateController@newType'));

//update fields
Route::put('updateUser',array('as'=>'updateUser','uses'=>'UpdateController@updateUser'));
Route::put('updateUser',array('as'=>'updateUser','uses'=>'UpdateController@updateUser'));

//delete fields
Route::delete('deleteUser/{idUser}',array('as'=>'deleteUser','uses'=>'DeleteController@deleteUser'));
Route::delete('deleteCategory/{idCategory}',array('as'=>'deleteCategory','uses'=>'DeleteController@deleteCategory'));
Route::delete('deleteProduct/{idProduct}',array('as'=>'deleteProduct','uses'=>'DeleteController@deleteProduct'));
Route::delete('deleteEstimation/{idEstimation}',array('as'=>'deleteEstimation','uses'=>'DeleteController@deleteEstimation'));
Route::delete('deleteType/{idType}',array('as'=>'deleteType','uses'=>'DeleteController@deleteType'));

Route::get('getListProduct/{id}',array('as'=>'getListProduct','uses'=>'ProductController@getListProduct'));