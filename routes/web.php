<?php

use Illuminate\Support\Facades\Route;


Route::domain('{tenancy}.multi-tenancy.test')->group(function () {
    Route::get('/', function ($tenancy) {
        return view('welcome');
    });
});
