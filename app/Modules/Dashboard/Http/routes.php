<?php
/*----------------------------------------------------------
Dashboard
----------------------------------------------------------*/
Route::group(['prefix' => '/dashboard','middleware' => 'authEngine'] , function () {
    $authController = App\Http\Controllers\DashboardController::class;
    Route::get('/',[$authController,'index']);
});

Route::group(['prefix' => '/dashboard/profile','middleware' => 'authEngine'] , function () {
    $authController = App\Http\Controllers\ProfileController::class;
    Route::get('/',[$authController,'index']);
    Route::post('/',[$authController,'update']);
});

Route::group(['prefix' => '/dashboard/settings','middleware' => 'authEngine'] , function () {
    $authController = App\Http\Controllers\SettingController::class;
    Route::get('/',[$authController,'index']);
    Route::post('/',[$authController,'updateSiteSettings']);

    Route::get('/general',[$authController,'general']);
    Route::post('/general',[$authController,'updateGeneralSettings']);

});