<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('signup',[SignupController::class,'signUp'])->middleware();