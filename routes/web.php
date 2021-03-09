<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::name('portal.')->group(function () {
    // Home Page
    Route::get('/', [App\Http\Controllers\PortalController::class, 'home'])->name('home');
    // Contact Page
    Route::get('/contact', [App\Http\Controllers\ContactsController::class, 'index'])->name('contact.index');
    Route::post('/contact', [App\Http\Controllers\ContactsController::class, 'save'])->name('contact.save');
    // FAQ Page
    Route::get('/faq', [App\Http\Controllers\PortalController::class, 'faq'])->name('faq');
    // Privacy Page
    Route::get('/privacy-policy', [App\Http\Controllers\PortalController::class, 'policy'])->name('policy');
    // Terms Page
    Route::get('/terms', [App\Http\Controllers\PortalController::class, 'terms'])->name('terms');

    // Graduados
    Route::resource('/graduate', \App\Http\Controllers\GraduateController::class);
    Route::get('/graduate/career/{career}', [\App\Http\Controllers\GraduateController::class, 'index_career'])->name('graduate.career');
    // Experiences
    Route::resource('/experience', \App\Http\Controllers\ExperienceController::class);
    // Certificate
    Route::resource('/certificate', \App\Http\Controllers\CertificateController::class);

    // Person
    Route::post('/person/reniec', [\App\Http\Controllers\PersonController::class, 'reniec'])->name('person.reniec');
    Route::resource('/person', \App\Http\Controllers\PersonController::class);

    // Gratuates -> Person
    Route::get('/person/{person}/graduate', [\App\Http\Controllers\PersonController::class, 'graduate_create'])->name('person.graduate.create');
    Route::put('/person/{person}/graduate', [\App\Http\Controllers\PersonController::class, 'graduate_store'])->name('person.graduate.store');
    // Experiences -> Person
    Route::get('/person/{person}/experience', [\App\Http\Controllers\PersonController::class, 'experience_create'])->name('person.experience.create');
    Route::put('/person/{person}/experience', [\App\Http\Controllers\PersonController::class, 'experience_store'])->name('person.experience.store');
    // Certificates -> Person
    Route::get('/person/{person}/certificate', [\App\Http\Controllers\PersonController::class, 'certificate_create'])->name('person.certificate.create');
    Route::put('/person/{person}/certificate', [\App\Http\Controllers\PersonController::class, 'certificate_store'])->name('person.certificate.store');

    // Panel | pagina de administracion
});
Route::get('/panel', [\App\Http\Controllers\PanelController::class, 'index'])->name('panel.index');


Auth::routes(['verify' => true, 'register' => false]);


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*
Route::group(['middleware' => ['verified']], function () {
    Route::prefix('panel')->name('panel.')->group(function () {

        Route::get('/', function () {
            return view('panel.index');
        })->name('index');

        // Route for Users
        //Route::model('users', 'User');
        //Route::resource('users', 'UserController')->only(['index', 'edit', 'update', 'destroy']);

        // profile updating
        Route::resource('profile', 'App\Http\Controllers\ProfileController')->only(['store', 'index']);
    });
});
*/
