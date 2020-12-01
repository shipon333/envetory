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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('users')->group(function(){
	Route::get('/view', 'backend\ControllerBackend@view')->name('user.view');
	Route::get('/add', 'backend\ControllerBackend@add')->name('user.add');
	Route::post('/store', 'backend\ControllerBackend@store')->name('user.store');
	Route::get('/edit/{id}', 'backend\ControllerBackend@edit')->name('user.edit');
	Route::post('/update/{id}', 'backend\ControllerBackend@update')->name('user.update');
	Route::post('/delete', 'backend\ControllerBackend@delete')->name('user.delete');

});
Route::prefix('profiles')->group(function(){
	Route::get('/view', 'backend\ControllerProfiels@view')->name('profiles.view');
	Route::get('/edit', 'backend\ControllerProfiels@edit')->name('profiles.edit');
	Route::post('/update', 'backend\ControllerProfiels@update')->name('profiles.update');
	Route::get('/change/password', 'backend\ControllerProfiels@changePassword')->name('profiles.password.view');
	Route::post('/update/password', 'backend\ControllerProfiels@updatePassword')->name('profiles.password.update');
});

Route::prefix('suppliers')->group(function(){
	Route::get('/view', 'backend\ControllerSuppliers@view')->name('suppliers.view');
	Route::get('/add', 'backend\ControllerSuppliers@add')->name('suppliers.add');
	Route::post('/store', 'backend\ControllerSuppliers@store')->name('suppliers.store');
	Route::get('/edit/{id}', 'backend\ControllerSuppliers@edit')->name('suppliers.edit');
	Route::post('/update/{id}', 'backend\ControllerSuppliers@update')->name('suppliers.update');
	Route::post('/delete', 'backend\ControllerSuppliers@delete')->name('suppliers.delete');
});

Route::prefix('customers')->group(function(){
	Route::get('/view', 'backend\ControllerCustomers@view')->name('customers.view');
	Route::get('/add', 'backend\ControllerCustomers@add')->name('customers.add');
	Route::post('/store', 'backend\ControllerCustomers@store')->name('customers.store');
	Route::get('/edit/{id}', 'backend\ControllerCustomers@edit')->name('customers.edit');
	Route::post('/update/{id}', 'backend\ControllerCustomers@update')->name('customers.update');
	Route::post('/delete','backend\ControllerCustomers@delete')->name('customers.delete');
	Route::get('/report', 'backend\ControllerCustomers@report')->name('customers.report.view');
	Route::get('/report/pdf', 'backend\ControllerCustomers@reportPdf')->name('coustomer.cradit.pdf');
	Route::get('/incoice/edit/{invoice_id}', 'backend\ControllerCustomers@cusEditIncoice')->name('customer.edit.invoice');
	Route::post('/incoice/update/{invoice_id}', 'backend\ControllerCustomers@cusUpdateIncoice')->name('customers.update.invoice');
	Route::get('/incoice/details/{invoice_id}', 'backend\ControllerCustomers@cusDetailsIncoice')->name('customer.details.invoice');
	Route::get('/incoice/details/pdf/{invoice_id}', 'backend\ControllerCustomers@cusDetailsIncoicePdf')->name('customer.invoice.details.pdf');

	Route::get('/paid/report', 'backend\ControllerCustomers@Paidreport')->name('customers.paid.view');
	Route::get('/paid/report/pdf', 'backend\ControllerCustomers@PaidreportPdf')->name('coustomer.paid.pdf');
	Route::get('/wise/report', 'backend\ControllerCustomers@CustomerWiseReport')->name('customers.wise.report');
		Route::get('/wise/credit/report', 'backend\ControllerCustomers@CustomerWiseCreditReport')->name('customers.wise.credit.report');
		Route::get('/wise/paid/report', 'backend\ControllerCustomers@CustomerWisePaidReport')->name('customers.wise.paid.report');
});

Route::prefix('units')->group(function(){
	Route::get('/view', 'backend\ControllerUnits@view')->name('units.view');
	Route::get('/add', 'backend\ControllerUnits@add')->name('units.add');
	Route::post('/store', 'backend\ControllerUnits@store')->name('units.store');
	Route::get('/edit/{id}', 'backend\ControllerUnits@edit')->name('units.edit');
	Route::post('/update/{id}', 'backend\ControllerUnits@update')->name('units.update');
	Route::post('/delete','backend\ControllerUnits@delete')->name('units.delete');
});

Route::prefix('categorys')->group(function(){
	Route::get('/view', 'backend\ControllerCategorys@view')->name('categorys.view');
	Route::get('/add', 'backend\ControllerCategorys@add')->name('categorys.add');
	Route::post('/store', 'backend\ControllerCategorys@store')->name('categorys.store');
	Route::get('/edit/{id}', 'backend\ControllerCategorys@edit')->name('categorys.edit');
	Route::post('/update/{id}', 'backend\ControllerCategorys@update')->name('categorys.update');
	Route::post('/delete','backend\ControllerCategorys@delete')->name('categorys.delete');
});

Route::prefix('products')->group(function(){
	Route::get('/view', 'backend\ControllerProducts@view')->name('products.view');
	Route::get('/add', 'backend\ControllerProducts@add')->name('products.add');
	Route::post('/store', 'backend\ControllerProducts@store')->name('products.store');
	Route::get('/edit/{id}', 'backend\ControllerProducts@edit')->name('products.edit');
	Route::post('/update/{id}', 'backend\ControllerProducts@update')->name('products.update');
	Route::post('/delete','backend\ControllerProducts@delete')->name('products.delete');
});

Route::prefix('purchases')->group(function(){
	Route::get('/view', 'backend\ControllerPurchases@view')->name('purchases.view');
	Route::get('/add', 'backend\ControllerPurchases@add')->name('purchases.add');
	Route::post('/store', 'backend\ControllerPurchases@store')->name('purchases.store');
	Route::get('/pending-view', 'backend\ControllerPurchases@pendingList')->name('purchases.pending.view');
	Route::get('/approve/{id}', 'backend\ControllerPurchases@approved')->name('approve.purchase');
	Route::post('/delete','backend\ControllerPurchases@delete')->name('purchases.delete');
});
Route::get('/get-category', 'backend\DefaultController@getCategory')->name('get-category');
Route::get('/get-product', 'backend\DefaultController@getProduct')->name('get-product');
Route::get('/get-product-stock', 'backend\DefaultController@getProductStock')->name('get-product-stock');


Route::prefix('invoices')->group(function(){
	Route::get('/view', 'backend\ControllerInvoices@view')->name('invoices.view');
	Route::get('/add', 'backend\ControllerInvoices@add')->name('invoices.add');
	Route::post('/store', 'backend\ControllerInvoices@store')->name('invoices.store');
	Route::get('/pending-view', 'backend\ControllerInvoices@pendingList')->name('invoices.pending.view');
	Route::get('/approve/{id}', 'backend\ControllerInvoices@approved')->name('approve.invoices');
	Route::post('/delete','backend\ControllerInvoices@delete')->name('invoices.delete');
	Route::post('/approve/store/{id}','backend\ControllerInvoices@approveStore')->name('approve.store');
	Route::get('/printing/list', 'backend\ControllerInvoices@printingList')->name('invoices.print.list');
	Route::get('/print/{id}', 'backend\ControllerInvoices@invoicePrint')->name('invoice.print');
	Route::get('/dely/report', 'backend\ControllerInvoices@delyReport')->name('invoices.dely.report');
	Route::get('/dely/report/pdf', 'backend\ControllerInvoices@delyReportPdf')->name('dely-report-pdf');
});

Route::prefix('stocks')->group(function(){
	Route::get('/view', 'backend\ControllerStocks@view')->name('stocks.view');
	Route::get('/report/pdf', 'backend\ControllerStocks@stockReport')->name('stock.report.pdf');
	Route::get('/supplier/view', 'backend\ControllerStocks@stockSupplier')->name('stock.supplier.view');
	Route::get('/supplier/pdf', 'backend\ControllerStocks@stockSupplierPdf')->name('supplier.stock.pdf');
	Route::get('/product/pdf', 'backend\ControllerStocks@stockProductPdf')->name('supplier.product.stock');
});


