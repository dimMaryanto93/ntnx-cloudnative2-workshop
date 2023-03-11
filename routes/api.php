<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/api_view','ClientController@api_view');
Route::get('/api_view/{id}','ClientController@api_show');
Route::post('/api_view/{id}','ClientController@api_modify');
Route::get('/api_new','ClientController@api_new');
Route::post('/api_new','ClientController@api_new');
Route::get('/api_reservations/{id}', 'RoomsController@checkAvailableRooms');
Route::post('/api_reservations/{id}', 'RoomsController@checkAvailableRooms');
Route::get('/api_checkAvailableRooms/{date_in}/{date_out}', 'RoomsController@api_checkAvailableRooms');
Route::get('/api_book/room/{client_id}/{room_id}/{date_in}/{date_out}', 'ReservationsController@bookRoom');
