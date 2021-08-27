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
        $this->publishes([
            __DIR__.'/../config/builder.php' => config_path('builder.php'),
            __DIR__.'/../config/project.php' => config_path('project.php'),
            __DIR__.'/../helpers/auth.php' => app_path('Helpers/auth.php'),
            __DIR__.'/../helpers/functions.php' => app_path('Helpers/functions.php'),
            __DIR__.'/../helpers/helpers.php' => app_path('Helpers/helpers.php'),
            __DIR__.'/../helpers/response.php' => app_path('Helpers/response.php'),
        ]);
        // 注册配置
        $this->commands('command.builder.package');
    }
}
