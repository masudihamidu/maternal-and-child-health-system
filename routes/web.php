<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotherController;
use App\Http\Controllers\HealthProfessionalController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\ImmunityController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\CliniCardController;
use App\Http\Controllers\Auth\MotherLoginController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\IndexController;
use App\Models\Mother;
use App\Http\Controllers\MaternalCardsAuthController;
use App\Http\Controllers\Auth\MaternalCardLoginController;



Route::get('/', function () {
    return view('index');
});

Route::get('/index', [IndexController::class, 'index'])->name('optionPage');
Route::get('/auth/login', [IndexController::class, 'professional'])->name('professional');
Route::get('/maternal/Auth', [IndexController::class, 'maternal'])->name('maternal');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth.maternal_cards'])->group(function () {
    Route::get('maternal-cards/dashboard', [MaternalCardsAuthController::class, 'dashboard'])->name('maternal-cards.dashboard');
});

// Routes for maternal cards
Route::prefix('maternal-cards')->group(function () {
    Route::get('login', [MaternalCardsAuthController::class, 'showLoginForm'])->name('maternal-cards.login');
    Route::post('login', [MaternalCardsAuthController::class, 'login']);
    Route::post('logout', [MaternalCardsAuthController::class, 'logout'])->name('maternal-cards.logout');
});

Route::post('maternalAuth/login', [MaternalCardLoginController::class, 'login'])->name('maternalAuth.login');
Route::post('maternalAuth/logout', [MaternalCardLoginController::class, 'destroy'])->name('maternal.logout');



// Healthcare professional
Route::get('/motherService', [ServiceController::class, 'index'])->name('motherService');
Route::get('/dashboard', [HealthProfessionalController::class, 'dashboard'])->name('dashboard');
Route::get('/motherImmunity', [ImmunityController::class, 'addImmunity'])->name('motherImmunity.addImmunity');
Route::get('/motherDisease', [DiseaseController::class, 'addDisease'])->name('motherDisease.addDisease');
Route::get('/motherInformation', [MotherController::class, 'motherDetails'])->name('motherInformation.motherDetails');
Route::get('/motherDetails', [MotherController::class, 'showClinicProgress'])->name('motherDetails.showClinicProgress');
Route::get('/fetch-daily-data', [ConversationController::class, 'fetchDailyData'])->name('fetch-daily-data');

Route::post('/mother_register', [MotherController::class, 'store'])->name('mother_register.store');
Route::post('/motherImmunity', [ImmunityController::class, 'storeImmunity'])->name('motherImmunity.storeImmunity');
Route::post('/motherService', [ServiceController::class, 'storeService'])->name('motherService.storeService');
Route::post('/motherDisease', [DiseaseController::class, 'storeDisease'])->name('motherDisease.storeDisease');
Route::post('/motherInformation', [MotherController::class, 'submitForm'])->name('motherInformation.submitForm');

// =========================================================


// conversation
Route::get('/ConversationAI.conversationAI', [ConversationController::class, 'showConversation'])->name('ConversationAI.showConversation');
Route::get('/import', [ConversationController::class, 'importJson']);
Route::get('/dashboard', [ConversationController::class, 'showAnalytics'])->name('dashboard');
// =========================================================================================================


// pdf report
Route::get('/report', [HealthProfessionalController::class, 'generatePdfReport'])->name('generatePdfReport');
Route::get('/reportMonthly', [HealthProfessionalController::class, 'generateMonthlyPdfReport'])->name('generateMonthlyPdfReport');
Route::get('/mother/pdf', [CliniCardController::class, 'generatePdf'])->name('mother.pdf');

// =======================================


Route::post('/mother/login', [MotherLoginController::class, 'login'])->name('mother.login');

// locations api
Route::get('/regions', [LocationController::class, 'getRegions'])->name('getRegions');
Route::get('/districts/{region}', [LocationController::class, 'getDistricts'])->name('getDistricts');
Route::get('/wards/{district}', [LocationController::class, 'getWards'])->name('getWards');
// =================================

route::get('/mother_register', [MotherController::class, 'index'])->name('mother_register.index');
route::get('registered_mothers', [MotherController::class, 'showRegisteredExpectant'])->name('registered_mothers.showRegisteredExpectant');



require __DIR__ . '/auth.php';
