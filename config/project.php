<?php
/**
 * Power by abnermouke/laravel-builder.
 * User: Abnermouke <abnermouke>
 * Originate in YunniTec.
 */

return [

    /*
   |--------------------------------------------------------------------------
   | Customer your project common config settings
   |--------------------------------------------------------------------------
   |
   | The default project settings
   |
   */

    'domains' => [

        // Custom your project domains

    ],

    // RSA 加密参数
    'rsa' => [
        //默认参数集合
        'default' => [
            // 内部私钥（PKCS8 JAVA适用版 - 下载支付宝开放平台开发助手可转换私钥格式）
            'inside_private_key_pkcs8' => '',
            // 内部私钥（PKCS1 非JAVA适用版 - 下载支付宝开放平台开发助手可转换私钥格式）
            'inside_private_key_pkcs1' => '',
            // 外部共钥（外部系统提供）
            'outside_public_key' => '',
            // 应用KEY
            'app_key' => '',
            // 应用SECRET
            'app_secret' => '',
        ],
    ],


    //

];
