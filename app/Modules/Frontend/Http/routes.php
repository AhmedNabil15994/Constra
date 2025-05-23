<?php
/*----------------------------------------------------------
Home
----------------------------------------------------------*/
Route::group(['prefix' => '/'] , function () {
    $homeController = App\Http\Controllers\HomeController::class;

    Route::get('/',[$homeController,'index']);
    Route::get('/about',[$homeController,'about']);
    Route::get('/categories',[$homeController,'categories']);
    Route::get('/categories/{id}',[$homeController,'companies']);

    Route::get('/companies/{id}',[$homeController,'company_details']);
    
    Route::get('/blogs',[$homeController,'blogs']);
    Route::get('/blogs/{id}',[$homeController,'blog_details']);
    
    Route::get('/ebook',[$homeController,'ebook']);

    Route::get('/contactUs',[$homeController,'contactUs']);
    Route::post('/contactUs',[$homeController,'postContactUs']);

    Route::get('/order',[$homeController,'order']);
    Route::post('/order',[$homeController,'postOrder']);
});