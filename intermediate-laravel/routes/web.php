<?php

use App\Events\OrderShipped;

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
    return view('welcome');
});

Route::get('/event', function() {
    $user = new App\User;
    event(new OrderShipped($user));
    return view('welcome');
});

Route::get('/contracts', function() {
    // dd(Config::get('database.default'));
    // dd(app('Illuminate\Config\Repository'))['database']['default'];
    // dd(app('Illuminate\Contracts\Config\Repository'))['database']['default'];
    // dd(app('Illuminate\Contracts\Config\Repository'));
    // dd(app()['config']['database']['default']);
});

Route::get('/test', 'WelcomeController@test');

Route::get('/middlewareteste', ['middleware' => 'auth', function() {
    return view('welcome');
}]);

// passando parâmetros para middleware
Route::get('/subs', ['middleware' => 'subscribed:yearly', function() {
    return view('welcome');
    // se for no controller:
    // $this->middleware('subscribed');
}]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/reports', 'ReportsController@index');