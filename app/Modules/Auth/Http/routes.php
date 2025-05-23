<?php
/*----------------------------------------------------------
Admin Auth
----------------------------------------------------------*/
Route::group(['prefix' => '/dashboard'] , function () {
    $authController = App\Http\Controllers\LoginController::class;

    Route::get('/login',[$authController,'showLogin']);
    Route::post('/login',[$authController,'doLogin']);
    Route::get('/logout',[$authController,'logout']);
    Route::get('/changeLang',[$authController,'changeLang']);
});