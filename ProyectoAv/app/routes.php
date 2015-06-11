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
Route::get('getUsers',array('as'=>'getUsers','uses'=>'UserController@getUsers'));
Route::get('getEstimations',array('as'=>'getEstimations','uses'=>'EstimationController@getEstimations'));
Route::get('getOrders',array('as'=>'getOrders','uses'=>'OrderController@getOrders'));
Route::get('getListProduct/{idcategory}',array('as'=>'getListProduct','uses'=>'ProductController@getListProduct'));
Route::get('getEstimation/{idestimation}',array('as'=>'getEstimation','uses'=>'EstimationController@getEstimation'));
Route::get('getOrder/{idorder}',array('as'=>'getOrder','uses'=>'OrderController@getOrder'));
Route::get('getupdateEstimation/{idestimation}',array('as'=>'getupdateEstimation','uses'=>'CategoryController@getupdateEstimation'));

Route::get('printEstimation/{idestimation}',array('as'=>'printEstimation','uses'=>'EstimationController@printEstimation'));
Route::get('printOrder/{idorder}',array('as'=>'printOrder','uses'=>'OrderController@printOrder'));


// create fields
Route::post('newUser',array('as'=>'newUser','uses'=>'CreateController@newUser'));
Route::post('newCategory',array('as'=>'newCategory','uses'=>'CreateController@newCategory'));
Route::post('newProduct',array('as'=>'newProduct','uses'=>'CreateController@newProduct'));
Route::post('newEstimation',array('as'=>'newEstimation','uses'=>'CreateController@newEstimation'));
Route::post('newType',array('as'=>'newType','uses'=>'CreateController@newType'));
Route::post('confirmestimation',array('as'=>'confirmestimation','uses'=>'CreateController@confirmEstimation'));
Route::post('newPayment',array('as'=>'newPayment','uses'=>'CreateController@newPayment'));
//update fields
Route::put('updateUser',array('as'=>'updateUser','uses'=>'UpdateController@updateUser'));
Route::put('updateCategory',array('as'=>'updateCategory','uses'=>'UpdateController@updateCategory'));
Route::put('updateProduct',array('as'=>'updateProduct','uses'=>'UpdateController@updateProduct'));
Route::put('updateEstimation',array('as'=>'updateEstimation','uses'=>'UpdateController@updateEstimation'));
Route::put('updateType',array('as'=>'updateType','uses'=>'UpdateController@updateType'));
Route::put('updateFacture',array('as'=>'updateFacture','uses'=>'OrderController@updateFacture'));
Route::put('updateStatus',array('as'=>'updateStatus','uses'=>'OrderController@updateStatus'));
Route::put('updatePay',array('as'=>'updatePay','uses'=>'OrderController@updatePay'));
Route::put('updateObservations',array('as'=>'updateObservations','uses'=>'OrderController@updateObservations'));

//delete fields
Route::delete('deleteUser/{idUser}',array('as'=>'deleteUser','uses'=>'DeleteController@deleteUser'));
Route::delete('deleteCategory/{idCategory}',array('as'=>'deleteCategory','uses'=>'DeleteController@deleteCategory'));
Route::delete('deleteProduct/{idProduct}',array('as'=>'deleteProduct','uses'=>'DeleteController@deleteProduct'));
Route::delete('deleteEstimation/{idEstimation}',array('as'=>'deleteEstimation','uses'=>'DeleteController@deleteEstimation'));
Route::delete('deleteType/{idType}',array('as'=>'deleteType','uses'=>'DeleteController@deleteType'));


// Route::get('getListProduct/{id}',array('as'=>'getListProduct','uses'=>'ProductController@getListProduct'));
