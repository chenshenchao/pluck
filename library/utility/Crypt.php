<?php namespace pluck\utility;

use pluck\facade\Path;

/**
 * 密码
 * 
 * 提供密码相关方法。
 */
final class Crypt {
    private $key;

    /**
     * 导入密钥。
     * 
     */
    public function __construct() {
        $path = Path::of('runtime', 'private.key');
        $text = file_get_contents($path);
        $this->key = openssl_pkey_get_private($text);
    }

    /**
     * 获取私钥。
     * 
     * @return mixed: 私钥资源。
     */
    public function getPrivateKey() {
        return $this->key;
    }
}