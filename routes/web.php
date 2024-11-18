<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
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

Route::get('/allPosts',[PostsController::class,'index']);
Route::get('/incidentReports',[IncidentReportController::class,'index']);
Route::get('/suspiciousReports',[SuspiciousReportController::class,'index']);
Route::get('/safetyReports',[SafetyReportController::class,'index']);
