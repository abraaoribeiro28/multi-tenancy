<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TenancyMiddleware;


Route::domain('{tenancy}.multi-tenancy.test')
    ->middleware(TenancyMiddleware::class)
    ->group(function () {
        Route::get('/', function ($tenancy) {
            dump(User::query()->first()->toArray());
        });
    });
