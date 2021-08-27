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
        $path .= ($version ? ((strpos($path, '?') !== false ? "&" : "?")."v=".config('builder.app_version')) : '');
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

if (!function_exists('init_sort_rules')) {
    /**
     * 初始化查询排序规则
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company <Macbook Pro>
     * @Time 2020-10-29 21:01:58
     * @param $sort_rules array 排序规则
     * @param string $table_name 批量设置表名
     * @return array
     * @throws \Exception
     */
    function init_sort_rules($sort_rules, $table_name = false)
    {
        //判断信息
        if (!$sort_rules || empty($sort_rules)) {
            //返回空
            return [];
        }
        //判断是否需要设置表名
        if (!$table_name) return $sort_rules;
        //循环排序规则
        foreach ($sort_rules as $k => $rule) {
            //判断是否已存在表名
            if (!strstr($k, '.')) {
                //设置表名
                $sort_rules[$table_name.'.'.$k] = $rule;
                //删除原数据
                unset($sort_rules[$k]);
            }
        }
        //返回排序规则
        return $sort_rules;
    }
}

if (!function_exists('create_qiniu_image_size')) {
    /**
     * 创建七牛图片大小参数信息
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company <Macbook Pro>
     * @Time 2020-07-27 10:49:16
     * @param $size mixed 大小参数信息
     * @param int $type 裁剪方案
     * @param string $version 图像处理引擎/版本
     * @return string
     * @throws \Exception
     */
    function create_qiniu_image_size($size, $type = 2, $version = 'imageView2') {
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

if (!function_exists('init_request_params')) {
    /**
     * 初始化请求参数方便保存
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company <Macbook Pro>
     * @Time 2020-10-22 03:18:46
     * @param $params
     * @return mixed
     * @throws \Exception
     */
    function init_request_params($params) {
        //判断信息
        if ($params && !empty($params)) {
            //循环参数信息
            foreach ($params as $k => $param) {
                //判断信息
                if (is_array($param) && !empty($param)) {
                    //整理信息
                    $param = \Illuminate\Support\Arr::query($param);
                }
                //判断信息
                $param = \Illuminate\Support\Str::length($param) > 200 ? ('__LONG_TEXT__:'.\Illuminate\Support\Str::length($param)) : $param;
                //设置参数信息
                $params[$k] = $param;
            }
        }
        //返回参数信息
        return $params;
    }
}

if (!function_exists('object_2_array'))
{
    /**
     * 对象转数组
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Abnermouke's MBP
     * @Time 2021-02-03 21:51:28
     * @param $object
     * @return array|mixed
     */
    function object_2_array($object)
    {
        return $object && $object !== '[]' ? (!is_array($object) ? json_decode($object, true) : $object) : [];
    }
}

if (!function_exists('amount_format')) {
    /**
     * 初始化金额
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Abnermouke's MBP
     * @Time 2021-04-01 17:47:18
     * @param int $amount
     * @return string
     */
    function amount_format($amount = 0)
    {
        //设置千
        $thousand = 1000;
        //设置万
        $million = 10000;
        //判断金额是否大于千
        if ($amount > $thousand) {
            //判断小于万
            if ($amount < $million) {
                //返回金额
                return sprintf("%.1f", (floor(($amount/$thousand) * 10)/10)).' 千';
            } else {
                //返回金额
                return sprintf('%.1f', (floor(($amount/$million)*10)/10)).' 万';
            }
        }
        //返回金额
        return number_format($amount, 2).' 元';
    }
}

if (!function_exists('file_size')) {
    /**
     * 获取文件大小描述
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company <Macbook Pro>
     * @Time 2020-09-05 16:38:05
     * @param int $file_size 文件大小
     * @return string
     * @throws \Exception
     */
    function file_size($file_size = 0) {
        //整理小数点位数
        $decimal_step = 0;
        //整理单位描述
        $format = 'bytes';
        //判断文件大小信息(KB级)
        if ((int)$file_size >= 1024 && (int)$file_size < pow(1024, 2)) {
            //重新整理信息
            $decimal_step = 1;
            $format = 'KB';
            $file_size /= pow(1024, (int)$decimal_step);
        }
        //判断文件大小信息(MB级)
        if ((int)$file_size >= pow(1024, 2) && (int)$file_size < pow(1024, 3)) {
            //重新整理信息
            $decimal_step = 2;
            $format = 'MB';
            $file_size /= pow(1024, (int)$decimal_step);
        }
        //判断文件大小信息(GB级)
        if ((int)$file_size >= pow(1024, 3) && (int)$file_size < pow(1024, pow(1024, 4))) {
            //重新整理信息
            $decimal_step = 3;
            $format = 'GB';
            $file_size /= pow(1024, (int)$decimal_step);
        }
        //判断文件大小信息(TB级)
        if ((int)$file_size >= pow(1024, 4) && (int)$file_size < pow(1024, 5)) {
            //重新整理信息
            $decimal_step = 3;
            $format = 'TB';
            $file_size /= pow(1024, (int)$decimal_step);
        }
        //返回大小信息
        return number_format($file_size, (int)$decimal_step).' '.$format;
    }
}

if (!function_exists('create_order_sn'))
{
    /**
     * 创建订单号
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Abnermouke's MBP
     * @Time 2021-02-04 02:41:25
     * @return string
     */
    function create_order_sn() {
        //整理开头信息
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        //整理订单编号
        return $yCode[intval(date('Y')) - 2017] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(1000, 9999)).strtoupper(\Illuminate\Support\Str::random(4));
    }
}

if (!function_exists('random_nickname'))
{
    /**
     * 获取随机昵称
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Abnermouke's MBP
     * @Time 2021-03-23 16:39:22
     * @param string $last_name
     * @param string $first_name
     * @return string
     */
    function random_nickname($last_name = '兜兜', $first_name = '')
    {
        //设置首名
        $first_names = ['快乐的','冷静的','醉熏的','潇洒的','糊涂的','积极的','冷酷的','深情的','粗暴的','温柔的','可爱的','愉快的','义气的','认真的','威武的','帅气的','传统的','潇洒的','漂亮的','自然的','专一的','听话的','昏睡的','狂野的','等待的','搞怪的','幽默的','魁梧的','活泼的','开心的','高兴的','超帅的','留胡子的','坦率的','直率的','轻松的','痴情的','完美的','精明的','无聊的','有魅力的','丰富的','繁荣的','饱满的','炙热的','暴躁的','碧蓝的','俊逸的','英勇的','健忘的','故意的','无心的','土豪的','朴实的','兴奋的','幸福的','淡定的','不安的','阔达的','孤独的','独特的','疯狂的','时尚的','落后的','风趣的','忧伤的','大胆的','爱笑的','矮小的','健康的','合适的','玩命的','沉默的','斯文的','香蕉','苹果','鲤鱼','鳗鱼','任性的','细心的','粗心的','大意的','甜甜的','酷酷的','健壮的','英俊的','霸气的','阳光的','默默的','大力的','孝顺的','忧虑的','着急的','紧张的','善良的','凶狠的','害怕的','重要的','危机的','欢喜的','欣慰的','满意的','跳跃的','诚心的','称心的','如意的','怡然的','娇气的','无奈的','无语的','激动的','愤怒的','美好的','感动的','激情的','激昂的','震动的','虚拟的','超级的','寒冷的','精明的','明理的','犹豫的','忧郁的','寂寞的','奋斗的','勤奋的','现代的','过时的','稳重的','热情的','含蓄的','开放的','无辜的','多情的','纯真的','拉长的','热心的','从容的','体贴的','风中的','曾经的','追寻的','儒雅的','优雅的','开朗的','外向的','内向的','清爽的','文艺的','长情的','平常的','单身的','伶俐的','高大的','懦弱的','柔弱的','爱笑的','乐观的','耍酷的','酷炫的','神勇的','年轻的','唠叨的','瘦瘦的','无情的','包容的','顺心的','畅快的','舒适的','靓丽的','负责的','背后的','简单的','谦让的','彩色的','缥缈的','欢呼的','生动的','复杂的','慈祥的','仁爱的','魔幻的','虚幻的','淡然的','受伤的','雪白的','高高的','糟糕的','顺利的','闪闪的','羞涩的','缓慢的','迅速的','优秀的','聪明的','含糊的','俏皮的','淡淡的','坚强的','平淡的','欣喜的','能干的','灵巧的','友好的','机智的','机灵的','正直的','谨慎的','俭朴的','殷勤的','虚心的','辛勤的','自觉的','无私的','无限的','踏实的','老实的','现实的','可靠的','务实的','拼搏的','个性的','粗犷的','活力的','成就的','勤劳的','单纯的','落寞的','朴素的','悲凉的','忧心的','洁净的','清秀的','自由的','小巧的','单薄的','贪玩的','刻苦的','干净的','壮观的','和谐的','文静的','调皮的','害羞的','安详的','自信的','端庄的','坚定的','美满的','舒心的','温暖的','专注的','勤恳的','美丽的','腼腆的','优美的','甜美的','甜蜜的','整齐的','动人的','典雅的','尊敬的','舒服的','妩媚的','秀丽的','喜悦的','甜美的','彪壮的','强健的','大方的','俊秀的','聪慧的','迷人的','陶醉的','悦耳的','动听的','明亮的','结实的','魁梧的','标致的','清脆的','敏感的','光亮的','大气的','老迟到的','知性的','冷傲的','呆萌的','野性的','隐形的','笑点低的','微笑的','笨笨的','难过的','沉静的','火星上的','失眠的','安静的','纯情的','要减肥的','迷路的','烂漫的','哭泣的','贤惠的','苗条的','温婉的','发嗲的','会撒娇的','贪玩的','执着的','眯眯眼的','花痴的','想人陪的','眼睛大的','高贵的','傲娇的','心灵美的','爱撒娇的','细腻的','天真的','怕黑的','感性的','飘逸的','怕孤独的','忐忑的','高挑的','傻傻的','冷艳的','爱听歌的','还单身的','怕孤单的','懵懂的'];
        //判断信息
        $first_name = !empty($first_name) ? $first_name : \Illuminate\Support\Arr::random($first_names);
        //组合信息
        return $first_name.$last_name;
    }
}

if (!function_exists('hidden_email_or_mobile')) {
    /**
     * 隐藏邮箱活手机号码
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Abnermouke's MBP
     * @Time 2021-03-25 02:54:58
     * @param $number
     * @return string|string[]
     */
    function hidden_email_or_mobile($number) {
        //判断是否为邮箱
        if (strpos($number, '@')) {
            //拆分号码
            $email_array = explode("@", $number);
            //获取前缀
            $prefix = (strlen($email_array[0]) < 4) ? "" : substr($number, 0, 3);
            //初始化次数
            $count = 0;
            //正则匹配
            $number = preg_replace('/([\d\w+_-]{0,100})@/', '***@', $number, -1, $count);
            //组合信息
            $rs = $prefix . $number;
        } else {
            //初始化电话验证规则
            $pattern = '/(1[3458]{1}[0-9])[0-9]{4}([0-9]{4})/i';
            //正则验证
            if (preg_match($pattern, $number)) {
                //处理结果
                $rs = preg_replace($pattern, '$1****$2', $number);
            } else {
                //直接处理
                $rs = substr($number, 0, 3) . str_repeat('*', strlen($number)-4) . substr($number, -1);
            }
        }
        //返回匹配结果
        return $rs;
    }
}
