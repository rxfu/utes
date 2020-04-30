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
        200006 => '修改密码成功',

        401001 => '用户未认证',
        401002 => '账户已锁定',
        403001 => '重置密码失败',
        403002 => '修改密码失败',
        403003 => '旧密码错误，请重新输入',
        403004 => '确认密码与新密码不一致，请重新输入',
        405001 => '提交方法错误',

        500001 => '对象创建失败',
        500002 => '对象更新失败',
        500003 => '对象删除失败',
        500004 => '对象不存在',
    ]
];
