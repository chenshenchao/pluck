<?php
/*****************************************************************************
 * Pluck 初始化
 * 
 * Pluck 初始化 Facade、类别名等。
 *****************************************************************************/

// Facade 绑定
think\Facade::bind([
    pluck\facade\Path::class => pluck\Path::class,
    pluck\facade\Sql::class => pluck\Sql::class,
]);

// 添加类别名
think\Loader::addClassAlias([
    'Path' => pluck\facade\Path::class,
    'Sql' => pluck\facade\Sql::class,
]);