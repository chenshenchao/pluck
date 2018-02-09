<?php namespace pluck;

use think\facade\Route;
use think\facade\Config;
use pluck\facade\Path;

/**
 * 
 */
final class Manager {
    /**
     * 
     */
    public function __construct() {

    }

    /**
     * 
     */
    public function manage() {
        $path = Path::of('config', 'pluck.php');
        if (is_file($path)) {
            Config::load($path, 'pluck');
            Route::group(Config::get('pluck.link'), function() {
                Route::get('$', 'pluck\controller\Index@index');
                Route::get('login$', 'pluck\controller\Index@login');
                Route::get('logout$', 'pluck\controller\Index@logout');
                Route::post('checkin$', 'pluck\controller\Reply@checkin');
            });
        } else { // 未安装情况下设置安装路由。
            Route::get('install$', 'pluck\controller\Setup@index');
            Route::get('install/:i$', 'pluck\controller\Setup@step', [], ['i' => '[1]']);
            Route::post('install$', 'pluck\controller\Setup@install');
        }
    }
}