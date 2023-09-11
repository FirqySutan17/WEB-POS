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
Route::post('/product/select', [App\Http\Controllers\ProductController::class, 'select'])->name('product.select');
Route::resource('/product', App\Http\Controllers\ProductController::class);
// Product Categories Route
Route::resource('/product-categories', App\Http\Controllers\ProductCategoriesController::class);

// Receive Route
Route::resource('/receive', App\Http\Controllers\ReceiveController::class);

// Membership Route
Route::get('/membership/select', [App\Http\Controllers\MembershipController::class, 'select'])->name('membership.select');
Route::resource('/membership', App\Http\Controllers\MembershipController::class);

// Cashflow Route
Route::resource('/cashflow', App\Http\Controllers\CashflowController::class);

// Transaction Route
Route::resource('/transaction', App\Http\Controllers\TransactionController::class);
Route::get('/transaction/receipt/{transaction}', [App\Http\Controllers\TransactionController::class, 'receipt'])->name('transaction.receipt');
Route::get('/summary-cashier', [App\Http\Controllers\TransactionController::class, 'summary'])->name('transaction.summary');
Route::get('/list-draft', [App\Http\Controllers\TransactionController::class, 'index_draft'])->name('transaction.listdraft');
Route::post('/check-pin', [App\Http\Controllers\TransactionController::class, 'check_pin'])->name('transaction.checkpin');

// Report Route
Route::match(['get', 'post'], '/report/stock', [App\Http\Controllers\ReportController::class, 'report_stock'])->name('report.stock');
Route::post('/report/stock/excel', [App\Http\Controllers\ReportController::class, 'report_stock_excel'])->name('report.stock.excel');
Route::post('/report/stock/pdf', [App\Http\Controllers\ReportController::class, 'report_stock_pdf'])->name('report.stock.pdf');

Route::match(['get', 'post'], '/report/transaction', [App\Http\Controllers\ReportController::class, 'report_transaction_by_date'])->name('report.transaction');
Route::post('/report/transaction/excel', [App\Http\Controllers\ReportController::class, 'report_transaction_by_date_excel'])->name('report.transaction.excel');
Route::post('/report/transaction/pdf', [App\Http\Controllers\ReportController::class, 'report_transaction_by_date_pdf'])->name('report.transaction.pdf');

Route::match(['get', 'post'], '/report/transaction-by-invoice', [App\Http\Controllers\ReportController::class, 'report_transaction_by_invoice'])->name('report.transactioninvoice');
Route::post('/report/transaction-by-invoice/excel', [App\Http\Controllers\ReportController::class, 'report_transaction_by_invoice_excel'])->name('report.transactioninvoice.excel');
Route::post('/report/transaction-by-invoice/pdf', [App\Http\Controllers\ReportController::class, 'report_transaction_by_invoice_pdf'])->name('report.transactioninvoice.pdf');

Route::match(['get', 'post'], '/report/transaction-by-product', [App\Http\Controllers\ReportController::class, 'report_transaction_by_product'])->name('report.transactionproduct');
Route::post('/report/transaction-by-product/excel', [App\Http\Controllers\ReportController::class, 'report_transaction_by_product_excel'])->name('report.transactionproduct.excel');
Route::post('/report/transaction-by-product/pdf', [App\Http\Controllers\ReportController::class, 'report_transaction_by_product_pdf'])->name('report.transactionproduct.pdf');

Route::match(['get', 'post'], '/report/receive', [App\Http\Controllers\ReportController::class, 'report_receive_by_date'])->name('report.receive');
Route::post('/report/receive/excel', [App\Http\Controllers\ReportController::class, 'report_receive_by_date_excel'])->name('report.receive.excel');
Route::post('/report/receive/pdf', [App\Http\Controllers\ReportController::class, 'report_receive_by_date_pdf'])->name('report.receive.pdf');

Route::match(['get', 'post'], '/report/receive-by-no', [App\Http\Controllers\ReportController::class, 'report_receive_by_no'])->name('report.receiveno');
Route::post('/report/receive-by-no/excel', [App\Http\Controllers\ReportController::class, 'report_receive_by_no_excel'])->name('report.receiveno.excel');
Route::post('/report/receive-by-no/pdf', [App\Http\Controllers\ReportController::class, 'report_receive_by_no_pdf'])->name('report.receiveno.pdf');

Route::match(['get', 'post'], '/report/receive-by-product', [App\Http\Controllers\ReportController::class, 'report_receive_by_product'])->name('report.receiveproduct');
Route::post('/report/receive-by-product/excel', [App\Http\Controllers\ReportController::class, 'report_receive_by_product_excel'])->name('report.receiveproduct.excel');
Route::post('/report/receive-by-product/pdf', [App\Http\Controllers\ReportController::class, 'report_receive_by_product_pdf'])->name('report.receiveproduct.pdf');

Route::match(['get', 'post'], '/report/transaction-by-cashier', [App\Http\Controllers\ReportController::class, 'report_transaction_by_cashier'])->name('report.transactioncashier');
Route::match(['get', 'post'], '/report/best-seller', [App\Http\Controllers\ReportController::class, 'report_best_seller'])->name('report.bestseller');

Route::match(['get', 'post'], '/report/cash-flow', [App\Http\Controllers\ReportController::class, 'report_cash_flow'])->name('report.cashflow');

Route::match(['get', 'post'], '/report/best-seller', [App\Http\Controllers\ReportController::class, 'report_best_seller'])->name('report.bestseller');