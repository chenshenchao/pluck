<?php namespace pluck\controller;

use pluck\facade\Path;
use pluck\facade\Crypt;
use pluck\facade\Folder;
use pluck\model\Administrator;

/**
 * 安装向导控制器
 * 
 * 提供安装 Pluck 的向导。
 */
final class Setup extends Basic {
    /**
     * 引导首页。
     * 
     */
    public function index() {
        return $this->fetch('setup/index', [
            'info' => [
                ['PHP Version', PHP_VERSION, PHP_VERSION >= 7.2],
                ['PDO', '', extension_loaded('pdo')],
                ['GD', '', extension_loaded('gd')],
                ['OpenSSL', '', extension_loaded('openssl')],
            ]
        ]);
    }

    /**
     * 设置步骤页。
     * 
     */
    public function step($i) {
        return $this->fetch("setup/step-$i");
    }

    /**
     * 安装。
     * 
     */
    public function install() {
        $post = request()->post();
        self::configure($post);
        self::makeKey();
        self::publishFrontend();
        self::initializeDatabase($post);
        return [ 'tip' => 'Ok' ];
    }

    /**
     * 生成密钥对。
     * 
     */
    private static function makeKey() {
        $privateKeyPath = Path::of('runtime', 'private.key');
        $publicKeyPath = Path::of('public', 'public.key');
        $key = Crypt::makePrivateKey($privateKeyPath);
        Crypt::makePublicKey($key, $publicKeyPath);
    }

    /**
     * 发布前端。
     * 
     */
    private static function publishFrontend() {
        $scriptsSource = Path::of('pluck', 'asset', 'scripts');
        $scriptsTarget = Path::of('public', 'scripts');
        $stylesSource = Path::of('pluck', 'asset', 'styles');
        $stylesTarget = Path::of('public', 'styles');
        Folder::copy($scriptsSource, $scriptsTarget);
        Folder::copy($stylesSource, $stylesTarget);
    }

    /**
     * 初始化数据库。
     * 
     */
    private static function initializeDatabase($post) {
        $path = pathof('pluck', 'asset', 'config', 'database.php');
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
        $file = fopen(pathof('config', 'database.php'), 'w');
        fputs($file, $configuration);
        fclose($file);
        \Sql::execute(pathof('pluck', 'asset', 'create.sql'), [
            '__PREFIX__' => $post['prefix'],
        ]);
        Administrator::add(
            $post['account'],
            $post['cipher']
        );
    }

    /**
     * 初始化设置。
     * 
     */
    private static function configure($post) {
        $path = pathof('pluck', 'asset', 'config', 'pluck.php');
        $configuration = str_replace([
            '__LINK__',
        ], [
            $post['link'],
        ], file_get_contents($path));
        $file = fopen(pathof('config', 'pluck.php'), 'w');
        fputs($file, $configuration);
        fclose($file);
    }
}