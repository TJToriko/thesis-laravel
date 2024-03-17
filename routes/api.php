<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/create-user', function () {
    $user = new User;
    $user->first_name = 'TJ';
    $user->last_name = 'Torrico';
    $user->email = 'torricotj@gmail.com';
    $user->username = 'torrico';
    $user->password = Hash::make('torrico');
    $user->save();

    return response()->json(['message' => 'User created successfully']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

