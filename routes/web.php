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

Route::get('/', function () {
//    $response = Http::withToken('29afec667988640134bb903726f0c53478ef5347')->get('https://qiita.com/api/v2/authenticated_user/items');
//    dd($response->json());
    return view('welcome');
});
