<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\Home\HomeController;
use App\Http\Controllers\Site\Product\ProductController;
use App\Http\Controllers\Site\Solution\SolutionController;
use App\Http\Controllers\Site\Organization\AboutUsController;
use App\Http\Controllers\Site\Organization\ContactController;
use App\Http\Controllers\Site\Organization\DownloadController;

// Route::get('/', function () {
//     return view('site.test');
// });

Route::resource('/', HomeController::class);
Route::resource('product', ProductController::class);
Route::resource('contact', ContactController::class);
Route::resource('aboutus', AboutUsController::class);
Route::resource('download', DownloadController::class);
Route::resource('solutions', SolutionController::class);

Route::get('download-file/{file}', [DownloadController::class, 'downloadFile']);

Route::get('product-by-category/{category}', [ProductController::class, 'productByCategory']);

Route::get('solution-by-type/{type}', [SolutionController::class, 'solutionByType']);
Route::get('solution-by-type-show/{type}', [SolutionController::class, 'show']);
