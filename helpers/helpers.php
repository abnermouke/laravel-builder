<?php
/**
 * Power by abnermouke/laravel-builder.
 * User: Abnermouke <abnermouke>
 * Originate in YunniTec.
 */

if (!function_exists('proxy_assets')) {
    /**
     * 资源地址获取
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company Yunnitec.
     * @Time 2020-06-22 14:54:15
     * @param $path string 资源路径
     * @param string $module 模块名称
     * @param bool $version 是否加上版本号
     * @return string
     * @throws \Exception
     */
    function proxy_assets($path, $module = 'console', $version = false)
    {
        //整理地址对应目录
        $path = config('app.url').'/'.$module.DIRECTORY_SEPARATOR.$path;
        //判断是否使用第三方存储资源文件
        switch (config('app.env', 'local')) {
            case 'production':

                //TODO : 整理线上第三方代理链接，如：七牛等其他OSS

                break;
            //预发布环境环境
            case 'release':

                //TODO : 整理线上测试第三方代理链接，与线上正是环境一致，如：七牛等其他OSS

                break;
        }
        //添加固定版本号
        $path .= (strpos($path, '?') !== false ? "&" : "?")."v=".($version && !empty($version) ? $version : config('builder.app_version'));
        //整理信息
        return $path;
    }
}

if (!function_exists('auto_datetime')) {
    /**
     * 自动转换（时间戳/日期）为指定格式
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company Yunnitec.
     * @Time 2020-06-18 23:20:09
     * @param string $format
     * @param string $time
     * @return false|string
     * @throws \Exception
     */
    function auto_datetime($format = 'Y-m-d H:i:s', $time = '')
    {
        //转换时间信息
        return date($format, to_time($time));
    }
}

if (!function_exists('validation_fails')) {
    /**
     * 返回验证错误
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company Yunnitec.
     * @Time 2020-07-03 23:35:30
     * @param $valid_field string 验证字段
     * @param string $message 错误信息
     * @return array[]
     * @throws \Exception
     */
    function validation_fails($valid_field, $message = '')
    {
        //设置信息
        return ['validations' => [$valid_field => [$message]]];
    }
}

if (!function_exists('seconds_to_time_string')) {
    /**
     * 秒数转时间描述信息
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company Yunnitec.
     * @Time 2020-07-08 22:58:42
     * @param int $seconds 秒数
     * @return string
     * @throws \Exception
     */
    function seconds_to_time_string($seconds = 0)
    {
        //获取时间信息
        $hour = floor($seconds/3600);
        $minute = floor(($seconds - 3600 * $hour)/60);
        $second = floor((($seconds-3600 * $hour) - 60 * $minute) % 60);
        //整理信息
        return ($hour < 10 ? '0'.$hour : $hour).':'.($minute < 10 ? '0'.$minute : $minute).':'.($second < 10 ? '0'.$second : $second);
    }
}