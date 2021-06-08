<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\StudentController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\Api\UsersController;

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

/*
Route::post("create-student","StudentController@createStudent");
Route::post("edit-student/{id}","StudentController@editStudents");
Route::get("students", "StudentController@studentsListing");
Route::get("student/{id}", "StudentController@studentDetail");
Route::delete("student/{id}", "StudentController@studentDelete");
*/

Route::apiResource('/expenses', ExpenseController::class);


//Route::get('/expenses', [ExpenseController::class, 'index']);
//Route::get('/expenses', 'ExpenseController@all')->name('expenses.all');

//Route::post('/expenses', [ExpenseController::class, 'store']);
// Route::post('/expenses', 'ExpenseController@store')->name('expenses.store');

//Route::get('/expenses/{expense}', [ExpenseController::class, 'show']);
// Route::get('/expenses/{expense}', 'ExpenseController@show')->name('expenses.show');

//Route::put('/expenses/{expense}', [ExpenseController::class, 'update']);
// Route::put('/expenses/{expense}', 'ExpenseController@update')->name('expenses.update');

//Route::delete('/expenses/{expense}', [ExpenseController::class, 'destory']);
// Route::delete('/expenses/{expense}', 'ExpenseController@destory')->name('expenses.destroy');

Route::post('/signup-user', [UsersController::class, 'create_user']);