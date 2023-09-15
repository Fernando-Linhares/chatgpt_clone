<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/session-user', function(Request $request) {

    if(!session('session_token')){
        session()->put(
            'session_token',
            $request
                ->user()
                ->createToken(
                    strtotime('now'),
                    ['*'],
                    new \DateTime('+1 day')
            )->plainTextToken
        );
    }

    $user = $request->user();

    return [
        'id'=> $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'token' => session('session_token')
    ];
});
