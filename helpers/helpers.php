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
    function proxy_assets($path, $module = '', $version = false)
    {
        //整理地址对应目录
        $path = config('app.url').'/'.($module && !empty($module) ? ($module.'/') : '').$path;
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


if (!function_exists('init_range_conditions')) {
    /**
     * 初始化范围筛选条件
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company Yunnitec.
     * @Time 2020-05-13 16:57:17
     * @param $conditions array 当前条件
     * @param $field string 处理字段
     * @param bool $min 最小值
     * @param bool $max 最大值
     * @return mixed
     * @throws \Exception
     */
    function init_range_conditions($conditions, $field, $min = false, $max = false)
    {
        //判断信息
        if ($min && $max) {
            //设置区间
            $conditions[$field] = ['between', [$min, $max]];
        } elseif ($min) {
            //设置最小
            $conditions[$field] = ['>=', $min];
        } elseif ($max) {
            //设置最大
            $conditions[$field] = ['<=', $max];
        }
        //返回筛选条件
        return $conditions;
    }
}

if (!function_exists('create_qiniu_image_size')) {
    /**
     * 创建七牛图片大小参数信息
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company <Macbook Pro>
     * @Time 2020-07-27 10:49:16
     * @param $size mixed 大小参数信息
     * @param string $version 图像处理引擎/版本
     * @param int $type 裁剪方案
     * @return string
     * @throws \Exception
     */
    function create_qiniu_image_size($size, $version = 'imageView2', $type = 2) {
        //判断尺寸信息
        if ($size && !empty($size)) {
            //拆分尺寸信息
            $size = explode('x', $size);
            //获取宽高信息
            $width = (int)head($size);
            $height = (int)\Illuminate\Support\Arr::last($size);
            //整理参数信息
            $prefix = '?'.$version.'/'.(int)$type.'/w/'.(int)$width.'/h/'.(int)$height;
        } else {
            //设置空白参数
            $prefix = '';
        }
        //返回参数
        return $prefix;
    }
}

if (!function_exists('auto_locale_field')) {
    /**
     * 根据当前语言获取字段名
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company <Macbook Pro>
     * @Time 2020-07-28 09:49:52
     * @param $field string 字段名
     * @param bool $locale 使用语言
     * @param bool $as 是否别名返回
     * @return string
     * @throws \Exception
     */
    function auto_locale_field($field, $locale = false, $as = true)
    {
        //整理设置语言信息
        $locale = !$locale || !in_array(strtolower($locale), ['zh-cn', 'en']) ? config('app.locale') : strtolower($locale);
        //设置字段信息
        if (strtolower($locale) !== 'zh-cn') {
            //设置字段信息
            $field .= $as ? ('_'.$locale.' as '.$field) : ('_'.$locale);
        }
        //返回字段信息
        return $field;
    }
}