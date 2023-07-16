<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Subject\Infrastructure\Controllers\SubjectController as SubjectControllerAlias;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    Route::post('repositories/{repositoryID}/subjects', [SubjectControllerAlias::class, 'createSubject']);
    Route::post('repositories/{repositoryID}/subjects/{subjectID}/projects/{projectID}', [SubjectControllerAlias::class, 'assignProjectToSubject']);
    Route::post('repositories/{repositoryID}/subjects/filter', [SubjectControllerAlias::class, 'filterSubjects']);
});
