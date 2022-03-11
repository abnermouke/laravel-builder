# laravel-builder - 一款高效的Laravel架构方案生成器

 Power By Abnermouke <abnermouke@outlook.com>

 此工具包由 Abnermouke <abnermouke@outlook.com> 开发并维护。

----

最后更新时间：2022年03月11日，持续更新中！！！

---

It is an efficient tool for developing Laravel Framework.
一款高效的Laravel框架开发工具



## Requirement - 依赖包

1. PHP >= 7.2
2. **[Composer](https://getcomposer.org/)**
3. Laravel Framework 6+



## Installation - 安装方法

```shell
$ composer require "abnermouke/laravel-builder"
```


### How to use it - 怎么使用

- Add the following class to the `providers` array in `config/app.php`:

   （ 在`config/app.php`的`providers`注册服务提供者 ）

```php
Abnermouke\LaravelBuilder\LaravelBuilderServiceProvider::class
```
- If you want to manually load it only in non-production environments, instead you can add this to your `AppServiceProvider` with the `register()` method:

    （ 如果你想只在非`production`的模式中使用构建器功能，可在`AppServiceProvider`中进行`register()`配置 ）

```php
public function register()
{
  if ($this->app->environment() !== 'production') {
      $this->app->register(\Abnermouke\LaravelBuilder\LaravelBuilderServiceProvider::class);
  }
  // ...
}
```

- This builder tool provides a config file to help you custom your build configs, you can generate files for your own.

    此构建工具提供一配置文件帮助开发者自行配置自己的构建配置，导出命令：

    ```shell
    php artisan vendor:publish --provider="Abnermouke\LaravelBuilder\LaravelBuilderServiceProvider"
    ```
  
- Add Middleware

    添加通用中间件至  app/Http/Kernel.php (如需在指定路由使用中间件，请将内容填充至 $routeMiddleware 内，并标记标识):


```php
protected $middleware = [
    
    ///
   
    \App\Middleware\LaravelBuilderBaseMiddleware::class,
];
```

- Add Autoload
    
    添加辅助函数自动加载至 composer.json

```php
     "autoload": {
       
       // 
        
        "files": [
            "app/Helpers/functions.php",
            "app/Helpers/helpers.php",
            "app/Helpers/auth.php",
            "app/Helpers/response.php"
        ]
    },
```

    
    



### Usage - 使用

Abnermouke provides an efficient development command for quickly building a framework

Abnermouke 提供了一些高效的构建命令帮助开发者快速使用构建器

```shell
$ php artisan builder:package {your-table-name-without-db-prefix}
```

example 例如

```shell
$ php artisan builder:package accounts
```

means to build a `accounts` packages

生成`accounts`相关的系列文件信息。

##### 更新进度

2020.10.16 - 新增结巴分词相关处理逻辑（Abnermouke\LaravelBuilder\Library\Currency\JiebaLibrary），请在使用前执行命令：

```shell
composer require fukuball/jieba-php
```

2020.10.16 - 新增php-DFA-filterWord相关处理逻辑（Abnermouke\LaravelBuilder\Library\Currency\SensitiveFilterLibrary），请在使用前执行命令：

```shell
composer require lustre/php-dfa-sensitive
```

2020.10.17 - 新增数据库处理对JSON的支持

2021.08.27 - 新增Session辅助函数，更改Builder构建逻辑，支持多目录结构构建，修复已知BUG（可无损更新）

2021.09.16 - 修复已知BUG，重构builder组件，支持多层级目录（不限层级）并新增部分常用验证规则（Abnermouke\LaravelBuilder\Library\Currency\ValidateLibrary），新增RSA非对称加解密方法，仅需配置内部私钥与外部公钥即可自动进行RSA加解密（可无损更新）,请在使用前确保openssl可用：

2021.10.22 - 修复加解密浮点数/数字等加密结果有误问题，新增 JSON_NUMERIC_CHECK|JSON_PRESERVE_ZERO_FRACTION 两种flag处理

```shell
composer require ext-openssl
```

2020.03.10 - 新增诸多功能

- 新增 LaravelBuilder 基础中间件，记录请求开始时间，response时可携带执行时间已确认服务器处理速度，请在app/Http/Kernel.php中添加通用路由：

```php
    protected $middleware = [
        
        ///
       
        \App\Middleware\LaravelBuilderBaseMiddleware::class,
    ];
```
- 新增 AesLibrary Aes加解密公共类，解析表单加密结果
- 新增 SignatureLibrary 验签公共类，提供create（创建）、verify（验证）方法快捷生成/验证签名
- 新增更多实用辅助函数
- 新增abort_error辅助函数，快速响应错误页面
- 新增 Repository 公共方法 uniqueCode 可生成唯一类型编码（md5、string、number等）

更多精彩，敬请期待！

## GIT Remark
```shell
git tag -d [tag]
git push origin :refs/tags/[tag]
```

## License

MIT
