<?php

use Illuminate\Support\Facades\Route;

$middleware = config('ab-test.middleware');
$urlPrefix = config('ab-test.url-prefix', 'ab-test');

Route::group([
    'namespace' => 'Bond211\ABTest\Controllers',
    'as' => "{$urlPrefix}.",
    'middleware' => $middleware,
], function () {
    Route::get('ab-tests', 'ABTestsController@index')->name('index');
});
