<?php

use App\Http\Services\QuickBooks;
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

    $qb = new QuickBooks();
    dd($qb->expense(['amount' => 1.16]));

    // return view('welcome');
});
