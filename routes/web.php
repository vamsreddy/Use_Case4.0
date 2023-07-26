<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ImagebotController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\CSVGenerateController;

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

Route::get('/chat', function () {
    return view('chat');
});
Route::get('/show',[ChatbotController::class,'index']);

Route::post('/chatbot', [ChatbotController::class, 'chat'])->name('chat.post');

Route::get('/image', function () {
    return view('image');
});
Route::post('/imagebot', [ImagebotController::class, 'image'])->name('image.generate');

Route::get('/openai', [OpenAIController::class , 'index']);
   
Route::post('/openai/process', [OpenAIController::class , 'processInput'])->name('openai.process');


Route::get('/generate',[CSVGenerateController::class , 'csvIndex'] );
Route::post('/generate-csv', [CSVGenerateController::class , 'generateCSV'])->name('generate.csv');
