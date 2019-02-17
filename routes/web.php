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
//     $tasks = [
//         'Go to the store',
//         'Go to the market',
//         'Go to work'
//     ];

//     return view('welcome', [
//         'tasks' => $tasks,
//         'foo' => 'foobar'
//     ]);

//     // return view('welcome')->withTasks($tasks)->withFoo('foo');
// });

// Route::get('/contact', function() {
//     return view('contact');
// });

// Route::get('/about', function() {
//     return view('about');
// });

// Para pequenos projetos, como APIs, as rotas podem ser utilizads dessa forma.
// Mas, geralmente, o controle é sempre feito nos Controllers.

// Esse nomeação de rotas não é RESTful:
Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');

Route::get('/projects', 'ProjectsController@index');