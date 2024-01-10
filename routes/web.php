<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuotationsController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });

/**
 * Dashboard Route
 * @author Seema kashyap
 */
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/get-graph-data', [DashboardController::class, 'getgraphData'])->name('dashboard.getgraphData');
Route::get('/export/create/quote/csv', [DashboardController::class, 'createQuoteDownload'])->name('createquotation.csv');
Route::get('/export/open/quote/csv', [DashboardController::class, 'openQuoteDownload'])->name('openquotation.csv');
Route::get('/export/won/quote/csv', [DashboardController::class, 'wonQuoteDownload'])->name('wonquotation.csv');
Route::get('/export/lost/quote/csv', [DashboardController::class, 'lostQuoteDownload'])->name('lostquotation.csv');


/**
 * Customers Route
 * @author Rajdipsinh Hada.
 */
Route::get('/customers/index', [CustomersController::class, 'index'])->name('customers.index');
Route::post('/customers/list', [CustomersController::class, 'list'])->name('customers.list');
Route::post('/customers/edit', [CustomersController::class, 'edit'])->name('customers.edit');
Route::post('/customers/update', [CustomersController::class, 'update'])->name('customers.update');
Route::post('/customers/create', [CustomersController::class, 'create'])->name('customers.create');
Route::post('/customers/store', [CustomersController::class, 'store'])->name('customers.store');
Route::post('/customers/search', [CustomersController::class, 'search'])->name('customers.search');

/**
 * Items Route
 * @author Rajdipsinh Hada.
 */

Route::get('/items/index', [ItemsController::class, 'index'])->name('items.index');
Route::post('/items/list', [ItemsController::class, 'list'])->name('items.list');
Route::post('/items/edit', [ItemsController::class, 'edit'])->name('items.edit');
Route::post('/items/update', [ItemsController::class, 'update'])->name('items.update');
Route::post('/items/create', [ItemsController::class, 'create'])->name('items.create');
Route::post('/items/store', [ItemsController::class, 'store'])->name('items.store');

/**
 * Quotations Routes
 * @author Rajdipsinh Hada
*/
Route::get('/quotations/index', [QuotationsController::class, 'index'])->name('quotations.index');
Route::post('/quotations/list', [QuotationsController::class, 'list'])->name('quotations.list');
Route::get('/quotations/create', [QuotationsController::class, 'create'])->name('quotations.create');
Route::get('/quotations/edit/{id}', [QuotationsController::class, 'edit'])->name('quotations.edit');
Route::post('/quotations/store', [QuotationsController::class, 'store'])->name('quotations.store');
Route::post('/quotations/update', [QuotationsController::class, 'update'])->name('quotations.update');
Route::post('/quotations/row-remove', [QuotationsController::class, 'remove_row'])->name('quotations.remove_row');
Route::post('/quotations/search_hsn', [QuotationsController::class, 'search_hsn'])->name('quotations.search_hsn');
Route::get('/quotations/export-pdf', [QuotationsController::class, 'export_quotation_pdf'])->name('quotations.export_quotation_pdf');
Route::post('/quotations/upload-purchase-quote', [QuotationsController::class, 'upload_purchase_quote'])->name('quotations.upload_purchase_quote');
Route::post('/quotations/purchase-quote-remove', [QuotationsController::class, 'file_remove'])->name('quotations.file_remove');

