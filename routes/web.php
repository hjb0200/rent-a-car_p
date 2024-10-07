<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\AuthController;

// 홈 페이지
Route::get('/', function () {
    return Inertia::render('Home');
});

// 차량 관련 라우트
Route::resource('cars', CarController::class);

// 예약 관련 라우트
Route::resource('reservations', ReservationController::class);

// 차량 등록 페이지
Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');

// 특정 차량 상세 정보 페이지
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

// 예약 생성 페이지
Route::get('/reservations/create/{car}', [ReservationController::class, 'create'])->name('reservations.create');

// 예약 저장 (폼 제출 후 동작)
Route::post('/reservations/store/{car}', [ReservationController::class, 'store'])->name('reservations.store');

// 로그인 라우트
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
