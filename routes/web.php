<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Wave\Facades\Wave;
use Illuminate\Support\Facades\Storage;

// Wave routes
Wave::routes();

Route::get('/gcs-test', function () {
  return Storage::disk('gcs')->files('', true);
});

Route::get('/gcs-test/{path}', function ($path) {
  $stream = Storage::disk('gcs')->readStream($path);
  $mime = Storage::disk('gcs')->mimeType($path);

  return response()->stream(function () use ($stream) {
    fpassthru($stream);
  }, 200, [
    'Content-Type' => $mime,
  ]);
})->where('path', '.*');
