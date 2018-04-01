<?php
/*****************************************************************************
 * Pluck 初始化
 * 
 * Pluck 初始化 Facade、类别名等。
 *****************************************************************************/

// Facade 绑定
think\Facade::bind([
    pluck\facade\Manager::class => pluck\Manager::class,
    pluck\facade\Sidebar::class => pluck\widget\Sidebar::class,
]);

// 添加类别名
think\Loader::addClassAlias([
    'Pluck' => pluck\facade\Manager::class,
    'Sidebar' => pluck\facade\Sidebar::class,
]);

// 定义路径
Path::let('pluck', __DIR__);

// 启用
Pluck::manage();