<?php
/*****************************************************************************
 * Pluck 初始化
 * 
 * Pluck 初始化 Facade、类别名等。
 *****************************************************************************/

// Facade 绑定
think\Facade::bind([
    pluck\facade\Crypt::class => pluck\utility\Crypt::class,
    pluck\facade\Path::class => pluck\utility\Path::class,
    pluck\facade\Sql::class => pluck\utility\Sql::class,
]);

// 添加类别名
think\Loader::addClassAlias([
    'Crypt' => pluck\facade\Crypt::class,
    'Path' => pluck\facade\Path::class,
    'Sql' => pluck\facade\Sql::class,
]);