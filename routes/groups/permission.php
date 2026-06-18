<?php

/*
 *--------------------------------------------------------------------------
 * Permission Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register Permission Routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 *
*/

use App\Modules\Lawyer\Http\Controllers\Admin\AdminCategoryController;
use App\Modules\Lawyer\Http\Controllers\Admin\AdminSubCategoryController;
use App\Modules\Lawyer\Http\Controllers\Admin\AdminLocationController;
use App\Modules\Lawyer\Http\Controllers\Admin\AdminLawyerController;
use App\Modules\Lawyer\Models\Category;
use App\Modules\Lawyer\Models\SubCategory;
use App\Modules\Lawyer\Models\Location;
use App\Modules\Lawyer\Models\Lawyer;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/lawyer')->name('lawyer.admin.')->group(function () {
    Route::resource('categories', AdminCategoryController::class)->names('categories');
    Route::resource('sub-categories', AdminSubCategoryController::class)->names('sub-categories');
    Route::resource('locations', AdminLocationController::class)->names('locations');
    Route::resource('lawyers', AdminLawyerController::class)->names('lawyers');

    Route::model('category', Category::class);
    Route::model('sub_category', SubCategory::class);
    Route::model('location', Location::class);
    Route::model('lawyer', Lawyer::class);
});
