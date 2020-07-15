<?php

namespace Abnermouke\LaravelBuilder\Library;

/**
 * Laravel Builder Code Library Power By Abnermouke
 * Class CodeLibrary
 * @package Abnermouke\LaravelBuilder\Library
 */
class CodeLibrary
{

    # 核心编码库 0 - 499
    public const CODE_ERROR = 0;
    public const CODE_SUCCESS = 200;
    public const VALIDATE_FAILED = 403;
    public const UNKNOWN = 404;
    public const CODE_LOGIC_ERROR = 500;
    public const NETWORK_ERROR = 501;
    public const TOO_MANY_REQUEST = 502;

    # 数据错误编码
    public const DATA_MISSING = 300;
    public const DATA_CAN_NOT_BE_CREATE = 301;
    public const DATA_CAN_NOT_BE_UPDATE = 302;
    public const DATA_CAN_NOT_BE_DELETE = 303;
    public const DATA_CREATE_FAIL = 304;
    public const DATA_UPDATE_FAIL = 305;
    public const DATA_DELETE_FAIL = 306;
    public const DATA_EXISTS = 307;
    public const MISSING_REQUIRE_PARAM = 308;
    public const REQUEST_PARAM_VERIFY_FAILED = 309;

    # 权限编码
    public const MISSING_PERMISSION = 400;
    public const WITH_DO_NOT_ALLOW_STATE = 401;
    public const PERMISSION_EXPIRED = 402;

}