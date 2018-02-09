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
     * @param string $path: 私钥路径。
     * @param string&... $data: 解密的信息字符串。
     */
    public static function decrypt($path, &...$data) {
        $text = file_get_contents($path);
        $key = openssl_get_privatekey($text);
        foreach($data as &$value) {
            $raw = base64_decode($value);
            openssl_private_decrypt($raw, $value, $key);
        }
    }

    /**
     * 生成密钥对。
     */
    public static function create($path, $bits=2048) {
        $key = openssl_pkey_new(['private_key_bits' => $bits]);
        openssl_pkey_export($key, $privateKey);
        $details = openssl_pkey_get_details($key);
        $publicKey = $details['key'];
        $file = fopen($path.'.key', 'wb');
        fputs($file, $privateKey);
        fclose($file);
        $file = fopen($path.'.public.key', 'wb');
        fputs($file, $publicKey);
        fclose($file);
    }

    /**
     * 生成私钥。
     * 
     */
    public static function makePrivateKey($path=null, $bits=2048) {
        $key = openssl_pkey_new(['private_key_bits' => $bits]);
        openssl_pkey_export($key, $text);
        if (isset($path)) {
            $file = fopen($path, 'wb');
            fputs($file, $text);
            fclose($file);
        }
        return $key;
    }

    /**
     * 生成公钥。
     * 
     */
    public static function makePublicKey($key, $path=null) {
        $details = openssl_pkey_get_details($key);
        $text = $details['key'];
        if (isset($path)) {
            $file = fopen($path, 'wb');
            fputs($file, $text);
            fclose($file);
        }
        return $text;
    }
}