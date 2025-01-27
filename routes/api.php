<?php

use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\LiveCourseController;
use App\Http\Controllers\AiMessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;

// Define the rate limiter for API routes
RateLimiter::for('api', function (Request $request) {
    return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
});

Route::middleware('api')->group(function () {
    Route::get('/instructors', [InstructorController::class, 'indexApi']);
    Route::get('/live-courses', [LiveCourseController::class, 'indexApi']);
    
    // AI Messages Routes
    Route::post('/ai-messages', [AiMessageController::class, 'apiStore']);
    Route::get('/ai-messages', [AiMessageController::class, 'index']);
    Route::get('/ai-messages/{aiMessage}', [AiMessageController::class, 'show']);
    Route::delete('/ai-messages/{aiMessage}', [AiMessageController::class, 'destroy']);
    
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});