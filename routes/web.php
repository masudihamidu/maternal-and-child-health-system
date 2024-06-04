<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotherController;
use App\Http\Controllers\HealthProfessionalController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\ImmunityController;
use App\Http\Controllers\ChatbotController;


Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/motherImmunity', [ImmunityController::class, 'addImmunity'])->name('motherImmunity.addImmunity');
Route::get('/motherDisease', [DiseaseController::class, 'addDisease'])->name('motherDisease.addDisease');
Route::get('/motherInformation', [MotherController::class, 'motherDetails'])->name('motherInformation.motherDetails');
route ::get('/mother_register',[MotherController::class,'index'])->name('mother_register.index');
route ::get('registered_mothers',[MotherController::class,'showRegisteredExpectant'])->name('registered_mothers.showRegisteredExpectant');
route ::get('/openAI.openAi',[MotherController::class,'showAIPage'])->name('openAI.showAIPage');


Route ::post('/mother_register',[MotherController::class,'store'])->name('mother_register.store');
Route ::post('/motherImmunity',[ImmunityController::class,'storeImmunity'])->name('motherImmunity.storeImmunity');
Route ::post('/motherDisease',[DiseaseController::class,'storeDisease'])->name('motherDisease.storeDisease');
Route::post('/motherInformation', [MotherController::class, 'submitForm'])->name('motherInformation.submitForm');

Route::post('send', [ChatbotController::class, 'sendChat']);

require __DIR__.'/auth.php';
