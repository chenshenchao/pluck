<?php
/*****************************************************************************
 * Pluck 初始化
 * 
 * Pluck 初始化容器、Facade、类别名等。
 *****************************************************************************/

// 容器绑定
think\Container::getInstance()->bind([
    'path' => pluck\Path::class,
]);

// Facade 绑定
think\Facade::bind([
    pluck\facade\Path::class => pluck\Path::class,
]);

// 添加类别名
think\Loader::addClassAlias([
    'Path' => pluck\facade\Path::class,
]);