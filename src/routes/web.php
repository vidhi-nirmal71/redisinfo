<?php

use Illuminate\Support\Facades\Route;
use Itpathsolutions\RedisInfo\Http\Controllers\RedisController;
    Route::get('/redis-info', [RedisController::class, 'index'])->name('redisinformation');
?>