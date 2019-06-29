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

// Route::get('/', function () {
    
// });
Route::get('/', ['as'=>'dashboard','uses'=>'BilanganRandomController@index']);
Route::post('/', ['as'=>'generate','uses'=>'BilanganRandomController@generate']);
Route::post('/random', ['as'=>'random', 'uses'=>'BilanganRandomController@random']);

Route::get('/chart', function() {
    $data = [
        "label" => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        "series" => [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900]
    ];
    return view('chart', compact('data'));
});