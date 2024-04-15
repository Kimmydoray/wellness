<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BucketController;

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


Route::get('/', [BucketController::class, 'index'])->name('buckets.index');

Route::post('/submit-form', [BucketController::class, 'handleFormSubmission'])->name('submit.form');
