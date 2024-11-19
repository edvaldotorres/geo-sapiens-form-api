<?php

use App\Http\Controllers\Api\V1\FormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1/forms/{form_id}')->group(function () {
    Route::post('fillings', [FormController::class, 'store'])
        ->name('forms.fillings.store');
    Route::get('fillings', [FormController::class, 'show'])
        ->name('forms.fillings.show');
});
