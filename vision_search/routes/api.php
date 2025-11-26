<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageDetectionController;

Route::post('/identify', [ImageDetectionController::class, 'detect']);
