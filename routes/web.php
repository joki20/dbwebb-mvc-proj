<?php

// classes within \Controllers
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;

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

Route::group(['middleware' => ['web']], function () {

// Added for mos example code
Route::get('/hello-world', function () {
    echo "Hello World";
});
Route::get('/hello-world-view', function () {
    return view('message', [
        'message' => "Hello World from within a view"
    ]);
});

// after ::class is name of function within class Dice
Route::get('/', function () {
    return view('home');
});

Route::get('/pokersquares', function () {
    return view('pokersquares');
});

Route::post('/pokersquares', function () {
    return view('pokersquares');
});

Route::get('/highscore', function () {
    return view('highscore');
});

Route::get('/histogram', function () {
    return view('histogram');
});

Route::get('/hello', [HelloWorldController::class, 'hello']);
Route::get('/hello/{message}', [HelloWorldController::class, 'hello']);

});
