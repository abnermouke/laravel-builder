<?php

namespace Abnermouke\LaravelBuilder\Library\Currency;

use Illuminate\Support\Arr;

/**
 * Laravel Builder Fake UserAgent Library Power By Abnermouke
 * Class FakeUserAgentLibrary
 * @package Abnermouke\LaravelBuilder\Library\Currency
 */
class FakeUserAgentLibrary
{
    /**
     * 获取随机UA
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company <Macbook Pro>
     * @Time 2020-09-24 14:08:19
     * @return array|mixed|string
     * @throws \Exception
     */
    public static function random()
    {
        //获取UA信息
        $userAgents = self::getFakeUserAgent();
        //随机获取设备
        $browser = Arr::random(array_values(data_get($userAgents, 'randomize', [])));
        //获取指定浏览器UA
        return self::browser($browser);
    }

    /**
     * 获取指定浏览器UA
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company <Macbook Pro>
     * @Time 2020-09-24 14:08:26
     * @param string $browser 'chrome', 'opera', 'firefox', 'internetexplorer', 'safari'
     * @param string $default 默认返回UA
     * @return array|mixed|string
     * @throws \Exception
     */
    public static function browser($browser = 'chrome', $default = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36')
    {
        //获取UA信息
        $userAgents = self::getFakeUserAgent();
        //获取全部UA
        $userAgents = data_get($userAgents, 'browsers.'.$browser, []);
        //判断是否存在UA
        if ($userAgents) {
            //获取一条并设为默认
            $default = Arr::random($userAgents);
        }
        //返回默认UA
        return $default;
    }

    /**
     * 获取伪造UA信息
     * @Author Abnermouke <abnermouke@gmail.com>
     * @Originate in Company <Macbook Pro>
     * @Time 2020-09-24 14:05:43
     * @return mixed
     * @throws \Exception
     */
    private static function getFakeUserAgent()
    {
        //获取json信息
        $ua = file_get_contents(__DIR__.'/../../../data/fake_useragent.json');
        //初始化信息
        return json_decode($ua, true);
    }

}