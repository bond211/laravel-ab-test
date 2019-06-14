<?php

namespace Bond211\ABTest;

use Illuminate\Support\ServiceProvider;

class ABTestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }
}
