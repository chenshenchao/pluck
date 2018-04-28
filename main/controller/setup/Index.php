<?php namespace pluck\controller\setup;

use pluck\controller\Basic;

/**
 * 
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