<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TimePeriodController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\SuspiciousReportController;
use App\Http\Controllers\SuspiciousReportCommentController;
use App\Http\Controllers\SuspiciousReportImageController;
use App\Http\Controllers\IncidentReportController;
use App\Http\Controllers\IncidentReportCommentController;
use App\Http\Controllers\IncidentReportImageController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SafetyReportController;
use App\Http\Controllers\SafetyReportCommentController;
use App\Http\Controllers\SafetyReportImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//ここから自分で記入
Route::controller(Controller::class)->middleware(['auth'])->group(function(){
    Route::get('/home','home')->name('home');
});
Route::controller(PostsController::class)->middleware(['auth'])->group(function(){
    Route::get('/allPosts','index');
    Route::get('/choose_post_type','choosePostType')->name('choose_post_type');
    Route::get('/my_posts', 'myIndex');
});

Route::controller(IncidentReportController::class)->middleware(['auth'])->group(function(){
    Route::get('/incident_reports','index');
    Route::get('/create_incident_report','create')->name('create_incident_report');
    Route::post('/create_incident_report', 'store');
    Route::get('/choose_incident_spot', 'chooseIncidentSpot');
});

Route::controller(SuspiciousReportController::class)->middleware(['auth'])->group(function(){
    Route::get('/suspicious_reports','index');
    Route::get('/create_suspicious_report','create')->name('create_suspicious_report');
    Route::post('/create_suspicious_report', 'store');
});

Route::controller(SafetyReportController::class)->middleware(['auth'])->group(function(){
    Route::get('/safety_reports','index');
    Route::get('/create_safety_report','create')->name('create_safety_report');
    Route::post('/create_safety_report', 'store');
});
