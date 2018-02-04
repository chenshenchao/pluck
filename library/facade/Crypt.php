<?php namespace pluck\facade;

use think\Facade;

/**
 * 密码
 * 
 * 提供不对称加密解密的功能方法。
 */
final class Crypt extends Facade {
    /**
     * 解密。
     * 
     * @param string $name: 密钥名。
     * @param string&... $data: 解密的信息字符串。
     */
    public static function decrypt($name, &...$data) {
        $path = Path::of('crypt', $name);
        $text = file_get_contents($path);
        $key = openssl_get_privatekey($text);
        foreach($data as &$value) {
            $raw = base64_decode($value);
            openssl_private_decrypt($raw, $value, $key);
        }
    }
}