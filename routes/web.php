<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Quinton\Applications\Http\Controllers\ApplicationController;

Route::group(['namespace' => 'Quinton\Applications\Http\Controllers'], function (): void {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'applications', 'as' => 'applications.'], function () {
            Route::resource('', ApplicationController::class)->parameters(['' => 'application']);

            Route::post('reply/{application}', [
                'as' => 'reply',
                'uses' => 'ApplicationController@postReply',
                'permission' => 'applications.edit',
            ])->wherePrimaryKey();
        });
    });

    if (defined('THEME_MODULE_SCREEN_NAME')) {
        Theme::registerRoutes(function (): void {
            Route::post('application/send', [
                'as' => 'public.send.application',
                'uses' => 'PublicController@postSendApplication',
            ]);
        });
    }
});
