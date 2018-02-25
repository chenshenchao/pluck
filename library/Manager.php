<?php namespace pluck;

use think\facade\Route;
use think\facade\Config;
use pluck\facade\Path;

/**
 * 管理器
 * 
 * 注册路由。
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
                Route::post('checkin$', 'pluck\controller\Reply@checkin');
                Route::get('logout$', 'pluck\controller\Index@logout');
                Route::get('administration$', 'pluck\controller\Index@administrate');
                Route::get('configuration$', 'pluck\controller\Index@configure');
                Route::post('configure/add$', 'pluck\controller\Reply@addVariant');
                Route::post('configure/amend$', 'pluck\controller\Reply@amendVariant');
                Route::post('administrator/add$', 'pluck\controller\Reply@addAdministrator');
                Route::post('administrator/amend$', 'pluck\controller\Reply@amendAdministrator');
                Route::group('archive', function() {
                    Route::get('$', 'pluck\controller\Draft@index');
                    Route::get('new$', 'pluck\controller\Draft@create');
                    Route::get('trash$', 'pluck\controller\Draft@trash');
                    Route::get('edit/:id$', 'pluck\controller\Draft@edit', [], ['id' => '\d+']);
                    Route::post('interact$', 'pluck\controller\Draft@interact');
                })->before(function() {
                    session('?admin') or abort(404);
                });
            });
        } else { // 未安装情况下设置安装路由。
            Route::get('install$', 'pluck\controller\Setup@index');
            Route::get('install/:i$', 'pluck\controller\Setup@step', [], ['i' => '[1]']);
            Route::post('install$', 'pluck\controller\Setup@install');
        }
    }
}