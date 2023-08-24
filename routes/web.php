<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ForgotPasswordController;
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

Route::get('/', function () {
  return redirect(route('login'));
});

Auth::routes([
  'register' => false
]);

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
  Route::view('/', 'admin.dashboard.default')->name('index');
  Route::view('home', 'admin.dashboard.default')->name('dashboard.index');

  Route::group(['prefix' => 'filemanager'], function () {
    Route::get('/folder', [App\Http\Controllers\FileManagerController::class, 'index'])->name('filemanager.index');
    \UniSharp\LaravelFilemanager\Lfm::routes();
  });
});

//Roles Route
Route::get('/roles/select', [App\Http\Controllers\RoleController::class, 'select'])->name('roles.select');
Route::resource('/roles', \App\Http\Controllers\RoleController::class);

//User Route
Route::resource('/users', \App\Http\Controllers\UserController::class);

// Meta Route
Route::resource('/metas', App\Http\Controllers\MetaController::class);

// Portfolio Route
Route::resource('/portfolio', App\Http\Controllers\PortfolioController::class);

//Skill Route
Route::get('/skill/select', [App\Http\Controllers\SkillController::class, 'select'])->name('skill.select');
Route::resource('/skill', App\Http\Controllers\SkillController::class);

//Project Type Route
Route::get('/project-type/select', [App\Http\Controllers\ProjectTypeController::class, 'select'])->name('project-type.select');
Route::resource('/project-type', App\Http\Controllers\ProjectTypeController::class);

// Dashboard Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile Route
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

// Password Route 
Route::get('/password', [App\Http\Controllers\PasswordController::class, 'edit'])->name('password.edit');
Route::post('/password', [App\Http\Controllers\PasswordController::class, 'updatePassword'])->name('password.updatePassword');

Route::group(['middleware' => 'auth'], function () {
  Route::get('/password', [App\Http\Controllers\PasswordController::class, 'edit'])->name('password.edit');
  Route::post('/password', [App\Http\Controllers\PasswordController::class, 'updatePassword'])->name('password.updatePassword');
});

// Forgot Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// Product Route
Route::post('/product/select_one', [App\Http\Controllers\ProductController::class, 'select_one'])->name('product.select_one');
Route::resource('/product', App\Http\Controllers\ProductController::class);
// Product Categories Route
Route::resource('/product-categories', App\Http\Controllers\ProductCategoriesController::class);

// Receive Route
Route::resource('/receive', App\Http\Controllers\ReceiveController::class);

// Transaction Route
Route::resource('/transaction', App\Http\Controllers\TransactionController::class);
Route::get('/edit-template', [App\Http\Controllers\TransactionController::class, 'edit_template'])->name('transaction.edite');
Route::get('/receipt-template', [App\Http\Controllers\TransactionController::class, 'print_receipt'])->name('transaction.receipt');

// Report Route
Route::get('/report/stock', [App\Http\Controllers\ReportController::class, 'report_stock'])->name('report.stock');
Route::get('/report/transaction', [App\Http\Controllers\ReportController::class, 'report_transaction'])->name('report.transaction');