<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\API\UserController;
    use App\Http\Controllers\API\Auth\LoginController;

    Route::get('/users/{id?}', [UserController::class, 'getUser']);
    Route::get('/users-by-email/{email?}', [UserController::class, 'getUserByEmail']);
    Route::post('/create-user', [UserController::class, 'createUser']);
    Route::put('/update-user/{id}', [UserController::class, 'userUpdate']);


    Route::post('auth/user-login', [LoginController::class, 'userLogin']);
    Route::post('auth/user-logout', [LoginController::class, 'userLogout']);