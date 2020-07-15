<?php
/**
 * Power by abnermouke2020/laravel-builder.
 * User: {__AUTHOR__} <{__AUTHOR_CONTACT_EMAIL}>
 * Originate in {__ORIGINATE__}
 * Date: {__DATE__}
 * Time: {__TIME__}
*/

namespace App\Model{__DICTIONARY__};

use Abnermouke\LaravelBuilder\Module\BaseModel;

/**
 * {__TABLE_NAME__}
 * Class {__CASE_NAME__}
 * @package App\Model{__DICTIONARY__}
*/
class {__CASE_NAME__} extends BaseModel
{
    //设置表名
    protected $table = self::TABLE_NAME;

    //定义表链接信息
    protected $connection = '{__DB_CONNECTION__}';

    //定义表名
    public const TABLE_NAME = '{__DB_PREFIX__}{__NAME__}';

    //定义表链接信息
    public const DB_CONNECTION = '{__DB_CONNECTION__}';

    //类型分组解释信息
    public const TYPE_GROUPS = [
        //
    ];
}
