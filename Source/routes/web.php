<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LoggedInUser;

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
Route::group(['middleware' => [LoggedInUser::class]], function(){
    Route::post('/upload', 'UploadController@upload');
    Route::get('/dashboard', function(){
        return view('dashboard');
    });
    Route::any('/images', 'ImageController@image_dashboard');
    Route::any('/my_images', 'ImageController@my_image_dashboard');
    Route::post('/edit_name', 'ImageController@edit_name');
    Route::post('/add_comment', 'ImageController@add_comment');
});

Route::get('/', function(){
    return view('login');
});
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

