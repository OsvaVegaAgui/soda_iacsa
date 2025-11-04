<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\IconsController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\WidgetsController;
use App\Http\Controllers\Controller;

Route::get('/', function () {
    return view('welcome');
});

/******** Dashboards ********/
Route::get('/', function () {
    return redirect('index'); // This will redirect '/' to '/index'
});

// Route::get('/', [DashboardsController::class, 'index']);
Route::get('index', [DashboardsController::class, 'index']);

Route::get('form-advanced', [PagesController::class, 'form_advanced']);
Route::get('form-check-radios', [PagesController::class, 'form_check_radios']);
Route::get('form-color-pickers', [PagesController::class, 'form_color_pickers']);
Route::get('form-datetime-pickers', [PagesController::class, 'form_datetime_pickers']);
Route::get('form-file-uploads', [PagesController::class, 'form_file_uploads']);
Route::get('form-input-group', [PagesController::class, 'form_input_group']);
Route::get('form-input-masks', [PagesController::class, 'form_input_masks']);
Route::get('form-inputs', [PagesController::class, 'form_inputs']);
Route::get('form-layout', [PagesController::class, 'form_layout']);
Route::get('form-range', [PagesController::class, 'form_range']);
Route::get('form-select', [PagesController::class, 'form_select']);
Route::get('form-select2', [PagesController::class, 'form_select2']);
Route::get('form-validation', [PagesController::class, 'form_validation']);
Route::get('form-wizards', [PagesController::class, 'form_wizards']);

Route::get('data-tables', [TablesController::class, 'data_tables']);
Route::get('grid-tables', [TablesController::class, 'grid_tables']);
Route::get('tables', [TablesController::class, 'tables']);
