# laravel-builder - 一款高效的Laravel架构方案生成器

 Power By Abnermouke <abnermouke@gmail.com>

 此工具包由Abnermouke<abnermouke@gmail.com>开发并维护。

---

📦 It is an efficient tool for developing Laravel Framework.
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

- This builder tool provides a config file to help you custom your build configs, you can use command `php artisan vendor:publish` and choose `providers` names `Abnermouke\LaravelBuilder\LaravelBuilderServiceProvider` to generate a `builder.php` config file for your own.

    此构建工具提供一配置文件帮助开发者自行配置自己的构建配置，可通过命令`php artisan vendor:publish`并选择服务提供者 `Abnermouke\LaravelBuilder\LaravelBuilderServiceProvider` 去生成自己的配置文件 `builder.php`。


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

## License

MIT

