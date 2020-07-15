<?php

namespace Abnermouke\LaravelBuilder;

use Abnermouke\LaravelBuilder\Commands\PackageCommands;
use Illuminate\Support\ServiceProvider;

class LaravelBuilderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //引入配置
        $this->app->singleton('command.builder.package', function ($app) {
            //返回实例
            return new PackageCommands($app['config']['builder']);
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 发布配置文件
        $this->publishes([__DIR__.'/../config/builder.php' => config_path('builder.php')]);
        // 注册配置
        $this->commands('command.builder.package');
    }
}
