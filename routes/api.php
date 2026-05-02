<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::post('/tasks',[TaskController::class,'stor']);
// Route::get('/tasks',[TaskController::class,'index']);
// Route::get('/tasks/{id}',[TaskController::class,'show']);
// Route::put('/tasks/{id}',[TaskController::class,'update']);
// Route::delete('/tasks/{id}',[TaskController::class,'delete']);

    


Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function(){

Route::get('task/all',[UserController::class,'getAllUsers'])->middleware('is_admin');


Route::apiResource('tasks',TaskController::class);
Route::get('task/orderd',[TaskController::class, 'getTasksOrdered']);

Route::apiResource('profile',ProfileController::class);

Route::get('user/{id}/profile',[UserController::class ,'getProfile']);
Route::get('user/{id}/tasks',[UserController::class,'getTasks']);
Route::get('task/{id}/user', [TaskController::class,'getUser']);
Route::get('user',[UserController::class,'GetUser']);

Route::post('task/{task_id}/categories',[TaskController::class,'AddCategoryToTask']);
});