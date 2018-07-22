<?php namespace pluck\controller\setup;

use think\Db;
use fi5e\facade\Sql;
use fi5e\facade\Path;
use fi5e\facade\Folder;
use pluck\controller\Basic;
use pluck\model\Administrator;

/**
 * 安装控制器
 * 
 * 处理 Pluck 的安装。
 */
final class Reply extends Basic {
    /**
     * 安装。
     * 
     */
    public function install() {
        $post = request()->post();
        try {
            self::configure($post);
            self::publishFrontend();
            $routesSource = Path::of('pluck', 'asset', 'route');
            $routesTarget = Path::of('route');
            Folder::copy($routesSource, $routesTarget);
            self::initializeDatabase($post);
            return [
                'code' => 0,
                'tip' => 'Ok'
            ];
        } catch (\Exception $e) {
            self::uninstall($post);
            return [
                'code' => 1,
                'tip' => $e->getMessage()
            ];
        }
    }

    /**
     * 发布前端。
     * 
     */
    private static function publishFrontend() {
        $scriptsSource = Path::of('pluck', 'asset', 'scripts');
        $scriptsTarget = Path::of('public', 'scripts');
        Folder::copy($scriptsSource, $scriptsTarget);

        $stylesSource = Path::of('pluck', 'asset', 'styles');
        $stylesTarget = Path::of('public', 'styles');
        Folder::copy($stylesSource, $stylesTarget);
    }

    /**
     * 初始化数据库。
     * 
     */
    private static function initializeDatabase($post) {
        $path = Path::of('pluck', 'asset', 'config', 'database.php');
        $configuration = str_replace([
            '__TYPE__',
            '__HOSTNAME__',
            '__HOSTPORT__',
            '__DATABASE__',
            '__USERNAME__',
            '__PASSWORD__',
            '__PREFIX__',
            '__CHARSET__',
        ], [
            $post['type'],
            $post['hostname'],
            $post['hostport'],
            $post['database'],
            $post['username'],
            $post['password'],
            $post['prefix'],
            $post['charset'],
        ], file_get_contents($path));
        $file = fopen(Path::of('config', 'database.php'), 'w');
        fputs($file, $configuration);
        fclose($file);
        Sql::execute(Path::of('pluck', 'asset', 'mysql', 'create.sql'), [
            '__PREFIX__' => $post['prefix'],
        ]);
        $password = $post['cipher'];
        Administrator::create([
            'id' => 100000000,
            'account' => $post['account'],
            'password' => Db::raw("UNHEX(SHA2('$password',256))"),
            'nickname' => 'Administrator',
        ]);
    }

    /**
     * 初始化设置。
     * 
     */
    private static function configure($post) {
        $path = Path::of('pluck', 'asset', 'config', 'pluck.php');
        $configuration = str_replace([
            '__LINK__',
        ], [
            $post['link'],
        ], file_get_contents($path));
        $file = fopen(Path::of('config', 'pluck.php'), 'w');
        fputs($file, $configuration);
        fclose($file);
    }

    /**
     * 卸载。
     * 
     */
    private static function uninstall($post) {
        $configurationPath = Path::of('config', 'pluck.php');
        $privateKeyPath = Path::of('runtime', 'private.key');
        $publicKeyPath = Path::of('public', 'public.key');
        unlink($configurationPath);
        unlink($privateKeyPath);
        unlink($publicKeyPath);
        Sql::execute(Path::of('pluck', 'asset', 'mysql', 'delete.sql'), [
            '__PREFIX__' => $post['prefix'],
        ]);
    }
}