<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotherController;
use App\Http\Controllers\HealthProfessionalController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\ImmunityController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\HuggingFaceController;
use App\Http\Controllers\ConversationController;



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
Route::get('/motherDetails', [MotherController::class, 'showClinicProgress'])->name('motherDetails.showClinicProgress');

route ::get('/mother_register',[MotherController::class,'index'])->name('mother_register.index');
route ::get('registered_mothers',[MotherController::class,'showRegisteredExpectant'])->name('registered_mothers.showRegisteredExpectant');
route ::get('/openAI.openAi',[ChatbotController::class,'showAIPage'])->name('openAI.showAIPage');
Route::post('/save-conversation', [ConversationController::class, 'store']);

Route ::post('/mother_register',[MotherController::class,'store'])->name('mother_register.store');
Route ::post('/motherImmunity',[ImmunityController::class,'storeImmunity'])->name('motherImmunity.storeImmunity');
Route ::post('/motherDisease',[DiseaseController::class,'storeDisease'])->name('motherDisease.storeDisease');
Route::post('/motherInformation', [MotherController::class, 'submitForm'])->name('motherInformation.submitForm');

Route::post('send', [ChatbotController::class, 'sendChat']);

Route::post('/openAI.openAi', [ChatbotController::class,'getCompletion'])->name('openAI.getCompletion');

Route::get('/openAI', [ChatbotController::class, 'showAIPage']);
Route::post('/sendChat', [ChatbotController::class, 'sendChat']);

require __DIR__.'/auth.php';
