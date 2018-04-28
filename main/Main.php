<?php namespace pluck;

use think\facade\Route;
use think\facade\Config;
use fi5e\facade\Path;

/**
 * Pluck 的主类
 * 
 * 注册路由。
 */
final class Main {
    /**
     * 初始化。
     * 
     */
    public function __construct() {
        $path = Path::of('config', 'pluck.php');
        if (is_file($path)) {
            Config::load($path, 'pluck');
            Route::group(Config::get('pluck.link'), function() {
                Route::get('$', 'pluck\controller\Index@index');
                Route::get('login$', 'pluck\controller\Index@login');
                Route::post('checkin$', 'pluck\controller\Reply@checkin');
                Route::get('logout$', 'pluck\controller\Index@logout');
                Route::get('administration$', 'pluck\controller\administrator\Index@index');
                Route::get('configuration$', 'pluck\controller\Index@configure');
                Route::post('configure/add$', 'pluck\controller\Reply@addVariant');
                Route::post('configure/amend$', 'pluck\controller\Reply@amendVariant');
                Route::post('administrator/add$', 'pluck\controller\administrator\Reply@append');
                Route::post('administrator/amend$', 'pluck\controller\administrator\Reply@amend');
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
            Route::get('install$', 'pluck\controller\setup\Index@index');
            Route::get('install/:i$', 'pluck\controller\setup\Index@step', [], ['i' => '[1]']);
            Route::post('install$', 'pluck\controller\setup\Reply@install');
        }
    }
}