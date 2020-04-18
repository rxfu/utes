<?php

return [
    'base' => env('MIX_BASE_URL', '/'),
    'name' => env('MIX_APP_NAME', 'Laradmin'),
    'slug' => env('MIX_APP_SLUG', 'Laradmin'),
    'keywords' => 'Laravel, Bootstrap, Admin template',
    'description' => 'An admin boilerplate developed with Bootstrap and AdminLTE base on Laravel',
    'author' => 'Fu Rongxin',
    'powerby' => 'Fu Rongxin',
    'copyright' => 'Laradmin Company',
    'password' => '123456',

    // 状态代码,
    'code' => [
        100001 => '对象正在更新',

        200001 => '对象创建成功',
        200002 => '对象更新成功',
        200003 => '对象删除成功',
        200004 => '登录成功',
        200005 => '登出成功',

        401001 => '用户未认证',
        401002 => '账户已锁定',

        500001 => '对象创建失败',
        500002 => '对象更新失败',
        500003 => '对象删除失败',
    ]
];
