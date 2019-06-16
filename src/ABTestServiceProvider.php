<?php

namespace Bond211\ABTest;

use Illuminate\Support\ServiceProvider;

class ABTestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        $this->loadViewsFrom(__DIR__ . '/../views', 'ab-tests');
    }
}
