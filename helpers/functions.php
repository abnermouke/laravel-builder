<?php
/**
 * Power by abnermouke/laravel-builder.
 * User: Abnermouke <abnermouke>
 * Originate in YunniTec.
 */

if (!function_exists('getRandChar')) {
    /**
     * 获取随机字符串
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Company Yunnitec.
     * @Time 2020-06-18 23:22:45
     * @param int $length 获取长度
     * @param bool $int 是否纯数字
     * @return false|string
     * @throws \Exception
     */
    function getRandChar($length = 6, $int = false)
    {
        //判断是否为整形
        if ($int) {
            //生成数字
            $str = '1234567890';
            //判断数字长度
            $len = (int)(ceil($length/strlen($str)));
            //整理数字长度
            $str = (int)($len) > 0 ? str_repeat($str, ((int)$len + 1)) : $str;
            //截取长度
            $number = substr(str_shuffle($str), 0, (int)($length));
            //判断第一位是否为0
            return (int)($number[0]) === 0 ? getRandChar($length, $int) : $number;
        }
        //返回随机数
        return \Illuminate\Support\Str::random((int)($length));
    }
}

if (!function_exists('filter_emoji')) {
    /**
     * 过滤表情
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Company Yunnitec.
     * @Time 2020-06-18 23:22:54
     * @param $str string 过滤信息
     * @return mixed
     * @throws \Exception
     */
    function filter_emoji($str)
    {
        //整理匹配规则
        $regex = '/(\\\u[ed][0-9a-f]{3})/i';
        //过滤信息
        return json_decode(preg_replace($regex, '', json_encode($str)), true);
    }
}

if (!function_exists('arraySequence')) {
    /**
     * 二维数组根据字段进行排序
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Company Yunnitec.
     * @Time 2020-06-18 23:25:05
     * @param $array array 二维数组信息
     * @param $field string 排序字段
     * @param string $sort 排序规则
     * @return mixed
     * @throws \Exception
     */
    function arraySequence($array, $field, $sort = 'SORT_ASC')
    {
        $arrSort = array();
        foreach ($array as $uniq_id => $row) {
            foreach ($row as $key => $value) {
                $arrSort[$key][$uniq_id] = $value;
            }
        }
        array_multisort($arrSort[$field], constant($sort), $array);
        return $array;
    }
}

if (!function_exists('to_time')) {
    /**
     * 转换时间信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Company Yunnitec.
     * @Time 2020-06-18 23:28:03
     * @param $time mixed 是啊见信息
     * @param bool $default
     * @return bool|int
     * @throws \Exception
     */
    function to_time($time, $default = false) {
        //判断时间信息
        if (!is_numeric($time) && !empty($time)) {
            //初始化信息
            $time = strtotime($time);
        }
        //初始化时间信息
        return (int)$time <= 0 ? ($default ? $default : time()) : (int)$time;
    }
}

if (!function_exists('friendly_time')) {
    /**
     * 友好的时间提示
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Company Yunnitec.
     * @Time 2020-07-31 14:45:55
     * @param $time mixed 时间信息
     * @param string $type 返回类型
     * @return bool|false|int|string
     * @throws \Exception
     */
    function friendly_time($time, $type = 'blurry') {
        //转换时间信息
        $time = to_time($time);
        //判断时间信息
        if (!$time) {return $time;}
        //获取当前时间
        $cTime = time();
        //获取已过时间
        $dTime = $cTime - $time;
        //获取已过天数
        $dDay = (int)$dTime/3600/24;
        //获取已过年数
        $dYear = (int)date('Y', $cTime) - (int)date('Y', $time);
        //根据处理类型处理
        switch (strtolower($type)) {
            case 'normal':
                //判断秒数
                if ((int)$dTime < 60) {
                    //判断时间小于10秒
                    if ($dTime < 10) {
                        //设置时间字符串
                        $timeString = '刚刚';
                    } else {
                        //设置时间字符串
                        $timeString = (int)(floor($dTime / 10) * 10).'秒前';
                    }
                } elseif ((int)$dTime < 3600) {
                    //设置时间字符串
                    $timeString = (int)($dTime / 60).'分钟前';
                } elseif ($dYear === 0 && date('d', $time) === date('d') && date('m', $time) === date('m')) {
                    //设置时间字符串
                    $timeString = (int)($dTime / 3600).'小时前';
                } elseif ((int)$dYear === 0) {
                    //设置时间字符串
                    $timeString = date('m-d', $time);
                } else {
                    //设置时间字符串
                    $timeString = date('Y-m-d', $time);
                }
                break;
            case 'simple':
                //判断秒数
                if ((int)$dTime < 60) {
                    //判断时间小于10秒
                    if ($dTime < 10) {
                        //设置时间字符串
                        $timeString = '刚刚';
                    } else {
                        //设置时间字符串
                        $timeString = (int)(floor($dTime / 10) * 10).'秒前';
                    }
                } elseif ((int)$dTime < 3600) {
                    //设置时间字符串
                    $timeString = (int)($dTime / 60).'分钟前';
                } elseif ($dYear === 0 && date('d', $time) === date('d')) {
                    //设置时间字符串
                    $timeString = (int)($dTime / 3600).'小时前';
                } elseif ((int)$dYear === 0) {
                    //设置时间字符串
                    $timeString = date('m-d', $time);
                } else {
                    //设置时间字符串
                    $timeString = date('Y-m-d', $time);
                }
                break;
            case 'full':
                //默认返回年月日时分秒
                $timeString = date('Y.m.d H:i:s', $time);
                break;
            case 'blurry':
                if ((int)$dTime < 60) {
                    //判断时间小于10秒
                    if ($dTime < 10) {
                        //设置时间字符串
                        $timeString = '刚刚';
                    } else {
                        //设置时间字符串
                        $timeString = $dTime . ' 秒前';
                    }
                } elseif ((int)$dTime < 3600) {
                    //设置时间字符串
                    $timeString = (int)($dTime / 60).'分钟前';
                } elseif ((int)$dTime >= 3600 && (int)$dDay === 0) {
                    //设置时间字符串
                    $timeString = (int)($dTime/3600).'小时前';
                } elseif ((int)$dDay > 0 && (int)$dDay <= 7) {
                    //设置时间字符串
                    $timeString = (int)$dDay.'天前';
                } elseif ((int)$dDay > 7 && (int)$dDay <= 30) {
                    //设置时间字符串
                    $timeString = (int)($dDay/7).'周前';
                } elseif ((int)$dDay > 30) {
                    //设置时间字符串
                    $timeString = (int)($dDay/30).'月前';
                }
                break;
            default:
                //默认返回年月日
                $timeString = date('Y.m.d', $time);
                break;
        }
        //返回时间字符串
        return $timeString;
    }

    if (!function_exists('friendly_number')) {
        /**
         * 友好的数值提示
         * @Author Abnermouke <abnermouke@outlook.com>
         * @Originate in Company Yunnitec.
         * @Time 2020-08-06 10:21:12
         * @param $number int 数值
         * @return string
         * @throws \Exception
         */
        function friendly_number($number)
        {
            //判断长度
            if ((int)$number >= 10000) {
                //获取倍数
                $number = round($number / 10000 * 100) / 100 . 'w+';
            } elseif ($number >= 1000) {
                //获取倍数
                $number = round($number / 1000 * 100) / 100 . 'k+';
            }
            //返回数值
            return $number;
        }
    }
}

if (!function_exists('encodeURIComponent')) {
    /**
     * url特殊字符处理
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Company Yunnitec.
     * @Time 2020-08-06 11:36:28
     * @param $str string 处理字符串
     * @return string
     * @throws \Exception
     */
    function encodeURIComponent($str) {
        //初始化默认字段
        $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
        //处理信息
        return strtr(rawurlencode($str), $revert);
    }
}


if (!function_exists('formatting_time')){
    /**
     * 格式化时间
     * @param $time
     * @param string $format
     * @return bool|int|string|null
     * @throws Exception
     */
    function formatting_time($time, $format = 'Y-m-d H:i:s'){
        //转换时间信息
        $time = to_time($time);
        //判断时间信息
        if (!$time) {return $time;}
        //返回指定时间
        return date($format, $time);
    }
}
