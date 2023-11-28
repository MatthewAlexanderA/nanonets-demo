<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\FakturPajakController;
use App\Http\Controllers\KtpController;
use App\Http\Controllers\StnkController;
use App\Http\Controllers\BpkbController;
use App\Http\Controllers\BankStatementController;
use App\Http\Controllers\NpwpController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\KartuKeluargaController;

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

Route::get('/', function () { return view('home'); });
Route::get('/invoice', function () { return view('model.invoice'); });
Route::get('/receipt', function () { return view('model.receipt'); });
Route::get('/faktur-pajak', function () { return view('model.faktur-pajak'); });
Route::get('/ktp', function () { return view('model.ktp'); });
Route::get('/stnk', function () { return view('model.stnk'); });
Route::get('/bpkb', function () { return view('model.bpkb'); });
Route::get('/bank-statement', function () { return view('model.bank-statement'); });
Route::get('/npwp', function () { return view('model.npwp'); });
Route::get('/passport', function () { return view('model.passport'); });
Route::get('/kartu-keluarga', function () { return view('model.kartu-keluarga'); });

Route::post('/extractInvoice', [InvoiceController::class, 'extract'])->name('extractInvoice');
Route::post('/extractReceipt', [ReceiptController::class, 'extract'])->name('extractReceipt');
Route::post('/extractFakturPajak', [FakturPajakController::class, 'extract'])->name('extractFakturPajak');
Route::post('/extractKtp', [KtpController::class, 'extract'])->name('extractKtp');
Route::post('/extractStnk', [StnkController::class, 'extract'])->name('extractStnk');
Route::post('/extractBpkb', [BpkbController::class, 'extract'])->name('extractBpkb');
Route::post('/extractBankStatement', [BankStatementController::class, 'extract'])->name('extractBankStatement');
Route::post('/extractNpwp', [NpwpController::class, 'extract'])->name('extractNpwp');
Route::post('/extractPassport', [PassportController::class, 'extract'])->name('extractPassport');
Route::post('/extractKartuKeluarga', [KartuKeluargaController::class, 'extract'])->name('extractKartuKeluarga');
