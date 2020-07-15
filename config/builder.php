<?php

return [

    /*
   |--------------------------------------------------------------------------
   | Database default setting and Cache setting
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
    'original' => 'Yunni Technology Co Ltd.'


];