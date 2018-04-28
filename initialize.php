<?php
/*****************************************************************************
 * Pluck 初始化
 * 
 * Pluck 初始化类别名等。
 *****************************************************************************/

use think\Facade;
use think\Loader;
use fi5e\facade\Path;
use pluck\facade\Main;
use pluck\facade\Sidebar;

// 添加类别名
Loader::addClassAlias([
    'Pluck' => Main::class,
    'Sidebar' => Sidebar::class,
]);

// 定义路径
Path::let('pluck', __DIR__);
