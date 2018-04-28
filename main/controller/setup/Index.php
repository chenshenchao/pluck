<?php namespace pluck\controller\setup;

use pluck\controller\Basic;

/**
 * 安装引导页面控制器
 * 
 * 提供安装 Pluck 的引导页面。
 */
final class Index extends Basic {
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
}