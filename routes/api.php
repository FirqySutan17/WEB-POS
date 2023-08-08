<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\MetaController;
use App\Http\Controllers\API\PortfolioController;
use App\Http\Controllers\API\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('meta-page', [MetaController::class, 'all']);
Route::post('contact', [ContactController::class, 'ContactForm']);

Route::get('portfolio', [PortfolioController::class, 'all']);
Route::get('portfolio/{slug}', [PortfolioController::class, 'show']);