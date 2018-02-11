<?php
/*****************************************************************************
 * Pluck 初始化
 * 
 * Pluck 初始化 Facade、类别名等。
 *****************************************************************************/

// Facade 绑定
think\Facade::bind([
    pluck\facade\Manager::class => pluck\Manager::class,
    pluck\facade\Crypt::class => pluck\utility\Crypt::class,
    pluck\facade\Folder::class => pluck\utility\Folder::class,
    pluck\facade\Html::class => pluck\utility\Html::class,
    pluck\facade\Path::class => pluck\utility\Path::class,
    pluck\facade\Sql::class => pluck\utility\Sql::class,
    pluck\facade\Sidebar::class => pluck\widget\Sidebar::class,
]);

// 添加类别名
think\Loader::addClassAlias([
    'Pluck' => pluck\facade\Manager::class,
    'Crypt' => pluck\facade\Crypt::class,
    'Folder' => pluck\facade\Folder::class,
    'Html' => pluck\facade\Html::class,
    'Path' => pluck\facade\Path::class,
    'Sql' => pluck\facade\Sql::class,
    'Sidebar' => pluck\facade\Sidebar::class,
]);

// 定义路径
Path::let('pluck', __DIR__);

// 启用
Pluck::manage();