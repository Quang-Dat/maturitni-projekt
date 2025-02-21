<?php

use App\Http\Controllers\KosikController;
use App\Http\Controllers\Menu_A_NapojeController;
use App\Http\Controllers\NapojovyListekController;
use App\Http\Controllers\ObjednavkyController;
use App\Http\Controllers\RecenzeController;
use App\Http\Controllers\StaleMenuController;
use App\Http\Controllers\StatistikyController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Objednavky;
use Illuminate\Support\Facades\Route;

// hlavni stranka
Route::get("/", [Menu_A_NapojeController::class, "menu_a_napoje"])->name("index");

// jidelni listek
Route::get("/produkty", [KosikController::class, "produkty"])->name("produkty");

// kosik
Route::get('/kosik', [ObjednavkyController::class, 'create'])->name('kosik')->middleware("auth");
Route::post('/kosik', [ObjednavkyController::class, 'store'])->name('kosik.store')->middleware("auth");

Route::get('/pdfdownload/{id}', [ObjednavkyController::class, "createPDF"])->name('pdf');

// recenze
Route::get('/recenze', [RecenzeController::class, 'create'])->name('recenze')->middleware("auth");
Route::post('/recenze', [RecenzeController::class, 'store'])->name('recenze.store')->middleware("auth");

// zprava
Route::post('/poslat-email', [Menu_A_NapojeController::class, 'poslatEmail'])->name('zprava.email');




//  Admin
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', AdminMiddleware::class])->name('dashboard');

// Dashboard pro napojový lístek
Route::prefix('/dashboard/napojovy-listek')->middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    Route::get("/", [NapojovyListekController::class, "index"])->name("napojovy_listek.index");

    Route::get('/pridat', [NapojovyListekController::class, 'create'])->name('napojovy_listek.create');
    Route::post('/pridat', [NapojovyListekController::class, 'store'])->name('napojovy_listek.store');

    Route::get('/upravit/{id}', [NapojovyListekController::class, 'edit'])->name('napojovy_listek.edit');
    Route::patch('/upravit/{id}', [NapojovyListekController::class, 'update'])->name('napojovy_listek.update');

    Route::patch('/smazat/{id}', [NapojovyListekController::class, 'destroy'])->name('napojovy_listek.destroy');
});

// Dashboard pro stale menu
Route::prefix('/dashboard/stale-menu')->middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    // Vypsání všeho, co je v menu
    Route::get("/", [StaleMenuController::class, "index"])->name("stale_menu.index");

    // Přidávání menu
    Route::get('/pridat', [StaleMenuController::class, 'create'])->name('stale_menu.create');
    Route::post('/pridat', [StaleMenuController::class, 'store'])->name('stale_menu.store');

    // Úprava menu
    Route::get('/upravit/{id}', [StaleMenuController::class, 'edit'])->name('stale_menu.edit');
    Route::patch('/upravit/{id}', [StaleMenuController::class, 'update'])->name('stale_menu.update');

    //Smazání menu z webu
    Route::patch('/smazat/{id}', [StaleMenuController::class, 'destroy'])->name('stale_menu.destroy');
});

// Dashboard pro objednávky
Route::prefix('/dashboard/objednavky')->middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    Route::get("/", [ObjednavkyController::class, "index"])->name("objednavky.index");

    Route::get('/{id}', [ObjednavkyController::class, 'show'])->name('objednavka.show');
    Route::post('/{id}', [ObjednavkyController::class, 'dokonceni'])->name('objednavka.dokoncit');
});

// Dashboard pro objednávky
Route::prefix('/dashboard/statistiky')->middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    Route::get('/jedna', [StatistikyController::class, 'jedna'])->name('statistiky.jedna');
});


require __DIR__ . '/auth.php';
