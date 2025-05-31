<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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
    return view('welcome');
});


Route::controller(ContactController::class)->group(function () {
    Route::get('/contacts', 'index')->name('contacts.index');
    Route::get('contacts/create', 'create')->name('contacts.create');
    Route::get('contacts/export', 'export')->name('contacts.export');
    Route::post('contacts', 'store')->name('contacts.store');
    Route::get('contacts/{contact}', 'show')->name('contacts.show');
    Route::get('contacts/{contact}/edit', 'edit')->name('contacts.edit');
    Route::put('contacts/{contact}', 'update')->name('contacts.update');
    Route::delete('contacts/{contact}', 'delete')->name('contacts.delete');
});
