<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;



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


use App\Http\Controllers\MikoController;
Route::get('/enkripsi', [MikoController::class, 'enkripsi']);

Route::get('/data/', [MikoController::class, 'data']);
Route::get('/data/{data_rahasia}', [MikoController::class, 'data_proses']);

Route::get('/hash', [MikoController::class, 'hash']);


use App\Http\Controllers\UploadController;
Route::get('/upload', [UploadController::class, 'upload']);
Route::post('/upload/proses', [UploadController::class, 'proses_upload']);

//hapus file
Route::get('/upload/hapus{id}', [UploadController::class, 'hapus']);


Route::get('/upload/hapus/{id}', function ($id) {
    Log::info('Route hit for id: ' . $id);
    return app('App\Http\Controllers\UploadController')->hapus($id);
});
