<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProcessAgreementController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\ActivityLogController;
use Arcanedev\LogViewer\Http\Controllers\LogViewerController;

use App\Exports\ProcessAgreementsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Only admin users can access this route
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store')->middleware('admin');
    Route::delete('/messages/{userId}/delete-all', [MessageController::class, 'deleteAllMessages'])->name('messages.deleteAll');
    Route::delete('/messages/delete-all-users-messages', [MessageController::class, 'deleteAllUsersMessages'])->name('messages.deleteAllUsersMessages');

    // Process agreement routes
    Route::resource('process_agreements', 'App\Http\Controllers\ProcessAgreementController');
    Route::get('/index', [App\Http\Controllers\ProcessAgreementController::class, 'index'])->name('process_agreements.index');
    Route::get('/create', [App\Http\Controllers\ProcessAgreementController::class, 'create'])->name('process_agreements.create');
    Route::get('/social', [ProcessAgreementController::class, 'social'])->name('social');
    Route::get('/poverty', [App\Http\Controllers\ProcessAgreementController::class, 'poverty'])->name('process_agreements.poverty');
    Route::get('/health-and-nutrition', [ProcessAgreementController::class, 'HealthandNutrition'])->name('process_agreements.health_and_nutrition');
    Route::get('/agriculture', [App\Http\Controllers\ProcessAgreementController::class, 'agriculture'])->name('agriculture');
    Route::get('/environment', [ProcessAgreementController::class, 'Environment'])->name('environment');
    Route::get('/government-revenue', [App\Http\Controllers\ProcessAgreementController::class, 'governmentRevenue'])->name('government_revenue');
    Route::get('/public-expenditure', [App\Http\Controllers\ProcessAgreementController::class, 'publicExpenditure'])->name('public_expenditure');
    Route::get('/other-details', [ProcessAgreementController::class, 'otherDetails'])->name('other-details');

    Route::get('/navigation', [ProcessAgreementController::class, 'showNavigation'])->name('process_agreements.navigation');
    Route::get('/workplaces/{district}', 'ProcessAgreementController@getWorkplacesByDistrict')->name('workplaces.by_district');
    Route::get('/process_agreements/{process_agreement}', [App\Http\Controllers\ProcessAgreementController::class, 'show'])->name('process_agreements.show');
    Route::get('/process_agreements/{process_agreement}/edit', [App\Http\Controllers\ProcessAgreementController::class, 'edit'])->name('process_agreements.edit');
    Route::post('/process_agreements', [App\Http\Controllers\ProcessAgreementController::class, 'store'])->name('process_agreements.store');
    Route::put('/process_agreements/{process_agreement}', [App\Http\Controllers\ProcessAgreementController::class, 'update'])->name('process_agreements.update');
    Route::delete('/process_agreements/{process_agreement}', [App\Http\Controllers\ProcessAgreementController::class, 'destroy'])->name('process_agreements.destroy');
    Route::post('/process_agreements/delete-filtered', [ProcessAgreementController::class, 'deleteFiltered'])->name('process_agreements.deleteFiltered');

    // Download routes
    Route::get('/download-csv', [ProcessAgreementController::class, 'downloadCSV'])->name('download.csv');
    Route::get('/download-excel', [ProcessAgreementController::class, 'downloadExcel'])->name('download.excel');
    Route::get('/download-pdf', [ProcessAgreementController::class, 'downloadPDF'])->name('download.pdf');
    // Route::get('export-csv', function (Request $request) {
    //     return Excel::download(new ProcessAgreementsExport($request->year, $request->district), 'process_agreements.csv');
    // })->name('export.csv');

    // Route::get('export-excel', function (Request $request) {
    //     return Excel::download(new ProcessAgreementsExport($request->year, $request->district), 'process_agreements.xlsx');
    // })->name('export.excel');

    // Route::get('export-pdf', function (Request $request) {
    //     return Excel::download(new ProcessAgreementsExport($request->year, $request->district), 'process_agreements.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    // })->name('export.pdf');

    // Message routes
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::get('/messages/fetch-workplaces', [MessageController::class, 'fetchWorkplaces'])->name('fetch.workplaces');
    Route::get('/messages/fetch-user-email', [MessageController::class, 'fetchUserEmail'])->name('fetch.user.email');
    Route::get('/messages/{userId}', [MessageController::class, 'show'])->name('messages.show');
    Route::get('/messages/{userId}/messages', [MessageController::class, 'fetchMessages'])->name('messages.user.messages');
    Route::get('/messages/fetch-messages', [MessageController::class, 'fetchMessages'])->name('messages.fetch.messages');
    Route::post('/messages/send-to-all', [MessageController::class, 'sendToAll'])->name('messages.sendToAll');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    // Route for storing replies
    Route::post('/replies/store', 'App\Http\Controllers\ReplyController@store')->name('replies.store');
    
    // Activity log routes
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity.logs.index');

    // Log Viewer routes
    Route::get('/activity/logs/{id}', [ActivityLogController::class, 'show'])->name('activity.logs.show');
});

// Routes accessible only to super admins and admins
Route::group(['middleware' => ['role:super-admin|admin']], function () {
    // Permission routes
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    // Role routes
    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    // User routes
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::delete('users/{userId}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    // Additional message routes for admin access
    Route::post('/fetch-user-email-by-workplace', [MessageController::class, 'fetchUserEmailByWorkplace'])->name('fetch.user.email.by.workplace');
});

// Fallback route
Route::fallback(function () {
    abort(404);
});


//Developed by G.R Gayan Kavinda Gamlath 
//gayankavinda98v.lk@gmail.com
//2024 SLIIT Internship 
//Ministry of Home Affairs (MOHA) 
