<?php
/**
 * Power by abnermouke/laravel-builder.
 * User: Abnermouke <abnermouke>
 * Originate in YunniTec.
 */

return [

    /*
   |--------------------------------------------------------------------------
   | Database default setting and Basic setting
   |--------------------------------------------------------------------------
   |
   | The default database settings
   |
   */

    'database_prefix' => env('DB_PREFIX', ''),
    'database_charset' => 'utf8mb4',
    'database_engine' => 'innodb',
    'database_connection' => 'mysql',

    'cache_driver' => 'file',

    'logic_request_log_time' => 0,

    'app_version' => env('APP_VERSION', rand(10000, 99999)),

    // Default builder packages
    'default_builder' => [
        'migration' => false,           //default build migration
        'data_cache' => true,           //default build data cache handler
        'controller' => false,          //default build controller
    ],


    /*
   |--------------------------------------------------------------------------
   | Author config
   |--------------------------------------------------------------------------
   |
   | The base config for author
   |
   */

    'author' => 'Abnermouke',
    'author_email' => 'abnermouke@gmail.com',
    'original' => 'Yunni Technology Co Ltd.',


];