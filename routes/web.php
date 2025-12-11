<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaleController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SubscriberController;

// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// О проекте
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Как помочь
Route::get('/help', [HomeController::class, 'help'])->name('help');

// Контакты
Route::get('/contacts', [HomeController::class, 'contacts'])->name('contacts');

// Инструкция
Route::get('/instructions', [HomeController::class, 'instructions'])->name('instructions');

// Сказки
Route::get('/tales', [TaleController::class, 'index'])->name('tales.index');
Route::get('/tales/{tale}', [TaleController::class, 'show'])->name('tales.show');

// Регионы/Народы
Route::get('/regions', [RegionController::class, 'index'])->name('regions.index');
Route::get('/regions/{region}', [RegionController::class, 'show'])->name('regions.show');

// Подписка на уведомления
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');
