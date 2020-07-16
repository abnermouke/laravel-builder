<?php

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