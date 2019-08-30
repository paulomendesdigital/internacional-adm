<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Site'], function() {

    Route::group(['prefix' => 'planos'], function() {

        Route::get('/', 'ClientController@index');

        Route::post('/store', 'ClientController@store');

        Route::get('/informacoes/{id}', 'ClientController@info');

        Route::put('/info-store', 'ClientController@infoStore');

        Route::get('/visualizar/{id}', 'ClientController@showPlans');

        Route::post('/enviar/mensagem', 'ClientController@sendEmail');

        Route::get('/recebido', 'ClientController@emailReceived');

    });

    Route::get('/quem-somos', 'SiteController@aboutUs');

    Route::get('/individual', 'SiteController@individual');

    Route::get('/coletivo-por-adesao', 'SiteController@coletivoPorAdesao');

    Route::get('/pequenas-e-medias-empresas', 'SiteController@pme');

    Route::get('/fale-conosco', 'SiteController@contactUs');

    Route::post('/fale-conosco/enviar', 'SiteController@contactUsSend');

    Route::get('/fale-conosco/recebido', 'SiteController@emailReceived');

    Route::get('/', 'SiteController@index');
});

Route::group(['namespace' => 'Panel'], function() {

    Route::get('/get-states-with-plans', 'StateController@getStatesWithPlans');

    Route::get('/get-cities-by-states-with-plans/{id}', 'StateController@getCitiesByStateWithPlans');
});

Route::group(['namespace' => 'Panel', 'prefix' => 'panel', 'middleware' => 'auth'], function() {

    Route::resource('/slides', 'SlideController');

    Route::get('/clients/view/{id}', 'ClientController@view');

    Route::get('/clients/export', 'ClientController@export')->name('clients.export');

    Route::resource('/clients', 'ClientController');

    Route::resource('/modalities', 'ModalityController');

    Route::resource('/profissions', 'ProfissionController');

    Route::resource('/elegibilidades', 'ElegibilidadeController');

    Route::resource('/operadoras', 'OperadoraController');

    Route::resource('/ages', 'AgeController');

    Route::resource('/states', 'StateController');

    Route::get('/get-states', 'StateController@getStates');

    Route::get('/get-cities-by-states/{id}', 'StateController@getCitiesByState');

    Route::get('/get-cities-by-states-client/{id}', 'StateController@getCitiesByStateClient');

    Route::resource('/cities', 'CityController');

    Route::resource('/plans', 'PlanController');

    Route::resource('/users', 'UserController');

    Route::get('/conf/edit/{id}', 'ConfigurationController@edit');

    Route::put('/conf/update/{id}', 'ConfigurationController@update');

    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    });

    Route::get('/clear-view-cache', function() {
        Artisan::call('view:clear');
        return "View cache is cleared";
    });

    Route::get('/clear-config-cache', function() {
        Artisan::call('config:cache');
        return "Config cache is cleared";
    });

    Route::get('/', 'DashboardController@index');

});

Auth::routes();
