<?php

use App\Http\Controllers\paiement;
use Illuminate\Support\Facades\Route;

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

 Route::get('/', [paiement::class,'index']);
 Route::post('/init', [paiement::class,'paie'])->name('init');
 
 Route::get('/retour', [paiement::class,'index'])->name('retour');
 Route::post('/retour', [paiement::class,'retour'])->name('retour');
 Route::post('/notify', [paiement::class,'notify'])->name('notify');
