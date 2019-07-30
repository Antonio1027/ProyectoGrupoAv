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

Route::post('signin',array('as'=>'signin','uses'=>'AuthController@signin'));
Route::get('printEstimation/{idestimation}/{token}',array('as'=>'printEstimation','uses'=>'EstimationController@printEstimation'));
Route::get('printOrder/{idorder}/{token}',array('as'=>'printOrder','uses'=>'OrderController@printOrder'));

Route::group(array('before' => 'jwt-auth'),function(){
	// AdminRoutes
	Route::group(array('before' => 'is_admin'),function(){
		Route::get('getPayment/{id}',array('as'=>'getPayment','uses'=>'OrderController@getPayment'));
		Route::get('getPayments',array('as'=>'getPayments','uses'=>'OrderController@getPayments'));
		Route::get('getUser/{iduser}',array('as'=>'getUser','uses'=>'UserController@getUser'));
		Route::get('getUsers',array('as'=>'getUsers','uses'=>'UserController@getUsers'));
		Route::post('newUser',array('as'=>'newUser','uses'=>'CreateController@newUser'));
		Route::put('updateUser',array('as'=>'updateUser','uses'=>'UpdateController@updateUser'));
		Route::put('updatePayment/{id}',array('as'=>'updatePayment','uses'=>'UpdateController@updatePayment'));
		Route::delete('deleteUser/{idUser}',array('as'=>'deleteUser','uses'=>'DeleteController@deleteUser'));
		Route::delete('deletePayment/{id}',array('as'=>'deletePayment','uses'=>'DeleteController@deletePayment'));
	});	

	Route::delete('deleteCategory/{idCategory}',array('as'=>'deleteCategory','uses'=>'DeleteController@deleteCategory'));

	Route::get('getCPT',array('as'=>'categories','uses'=>'CategoryController@categories'));
	Route::get('getEstimations',array('as'=>'getEstimations','uses'=>'EstimationController@getEstimations'));
	Route::get('getOrders',array('as'=>'getOrders','uses'=>'OrderController@getOrders'));
	Route::get('getListProduct/{idcategory}',array('as'=>'getListProduct','uses'=>'ProductController@getListProduct'));
	Route::get('getEstimation/{idestimation}',array('as'=>'getEstimation','uses'=>'EstimationController@getEstimation'));
	Route::get('getOrder/{idorder}',array('as'=>'getOrder','uses'=>'OrderController@getOrder'));
	Route::get('getupdateEstimation/{idestimation}',array('as'=>'getupdateEstimation','uses'=>'CategoryController@getupdateEstimation'));



	// create fields
	Route::post('newCategory',array('as'=>'newCategory','uses'=>'CreateController@newCategory'));
	Route::post('newProduct',array('as'=>'newProduct','uses'=>'CreateController@newProduct'));
	Route::post('newEstimation',array('as'=>'newEstimation','uses'=>'CreateController@newEstimation'));
	Route::post('newType',array('as'=>'newType','uses'=>'CreateController@newType'));
	Route::post('confirmestimation',array('as'=>'confirmestimation','uses'=>'CreateController@confirmEstimation'));
	Route::post('newPayment',array('as'=>'newPayment','uses'=>'CreateController@newPayment'));
	Route::post('newExtratype',array('as'=>'newExtratype','uses'=>'CreateController@newExtratype'));
	//update fields
	Route::put('updateCategory',array('as'=>'updateCategory','uses'=>'UpdateController@updateCategory'));
	Route::put('updateProduct',array('as'=>'updateProduct','uses'=>'UpdateController@updateProduct'));
	Route::put('updateEstimation',array('as'=>'updateEstimation','uses'=>'UpdateController@updateEstimation'));
	Route::put('updateType',array('as'=>'updateType','uses'=>'UpdateController@updateType'));
	Route::put('updateFacture',array('as'=>'updateFacture','uses'=>'OrderController@updateFacture'));
	Route::put('updateStatus',array('as'=>'updateStatus','uses'=>'OrderController@updateStatus'));
	Route::put('updatePay',array('as'=>'updatePay','uses'=>'OrderController@updatePay'));
	Route::put('updateObservations',array('as'=>'updateObservations','uses'=>'OrderController@updateObservations'));

	//delete fields
	Route::delete('deleteProduct/{idProduct}',array('as'=>'deleteProduct','uses'=>'DeleteController@deleteProduct'));
	Route::delete('deleteEstimation/{idEstimation}',array('as'=>'deleteEstimation','uses'=>'DeleteController@deleteEstimation'));
	Route::delete('deleteType/{idType}',array('as'=>'deleteType','uses'=>'DeleteController@deleteType'));
	Route::delete('deleteExtratype/{idExtratype}',array('as'=>'deleteExtratype','uses'=>'DeleteController@deleteExtratype'));
});
