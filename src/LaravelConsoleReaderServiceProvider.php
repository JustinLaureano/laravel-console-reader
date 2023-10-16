<?php

namespace Jmlaureano\LaravelConsoleReader;

use Illuminate\Support\ServiceProvider;
use Jmlaureano\LaravelConsoleReader\Console\Commands\Links;
use Jmlaureano\LaravelConsoleReader\Console\Commands\Post;

class LaravelConsoleReaderServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Links::class,
                Post::class
            ]);
        }
    }
}
