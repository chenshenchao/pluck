<?php namespace pluck;
/*****************************************************************************
 * Pluck 初始化
 * 
 * Pluck 初始化 Facade、类别名等。
 *****************************************************************************/

use think\Facade;
use think\Loader;
use fi5e\facade\Path;
use Pluck;

// Facade 绑定
Facade::bind([
    facade\Manager::class => Manager::class,
    facade\Sidebar::class => widget\Sidebar::class,
]);

// 添加类别名
Loader::addClassAlias([
    'Pluck' => facade\Manager::class,
    'Sidebar' => facade\Sidebar::class,
]);

// 定义路径
Path::let('pluck', __DIR__);

// 启用
Pluck::manage();