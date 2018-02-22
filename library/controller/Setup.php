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
        $infos = [
            ['PHP Version', PHP_VERSION, PHP_VERSION >= 7.2],
            ['PDO', '', extension_loaded('pdo')],
            ['GD', '', extension_loaded('gd')],
            ['OpenSSL', '', extension_loaded('openssl')],
        ];
        $able = true;
        foreach ($infos as &$info) {
            $able &= $info[2];
            if (!$info[2]) $info[1] = 'error';
        }
        return $this->fetch('setup/index', [
            'info' => $infos,
            'able' => $able,
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
        try {
            self::configure($post);
            self::makeKey();
            self::publishFrontend();
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
        \Sql::execute(Path::of('pluck', 'asset', 'create.sql'), [
            '__PREFIX__' => $post['prefix'],
        ]);
        $password = $post['cipher'];
        Administrator::create([
            'id' => 100000000,
            'name' => 'Administrator',
            'account' => $post['account'],
            'password' => ['exp', "UNHEX(MD5('$password'))"],
            'priority' => 0,
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
        \Sql::execute(Path::of('pluck', 'asset', 'delete.sql'), [
            '__PREFIX__' => $post['prefix'],
        ]);
    }
}