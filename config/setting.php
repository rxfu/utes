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
        401001 => '用户名或密码错误',
        401002 => '用户未认证',
        500001 => '对象创建失败',
        500002 => '对象更新失败',
        500003 => '对象删除失败',
    ]
];
