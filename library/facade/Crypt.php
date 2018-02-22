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
        $key = openssl_pkey_get_private($text);
        foreach($data as &$value) {
            $raw = base64_decode($value);
            if (!openssl_private_decrypt($raw, $value, $key)) {
                trace(openssl_error_string(), 'warning');
            }
        }
    }

    /**
     * 
     */
    public static function encrypt($path, &...$data) {
        $text = file_get_contents($path);
        $key = openssl_pkey_get_private($text);
        foreach($data as &$value) {
            if (!openssl_private_encrypt($value, $value, $key)) {
                trace(openssl_error_string(), 'warning');
            }
            $value = base64_encode($value);
        }
    }

    /**
     * 
     */
    public static function publicKeyEncrypt($path, ...$data) {
        $text = file_get_contents($path);
        $key = openssl_pkey_get_public($text);
        foreach($data as &$value) {
            if (!openssl_public_encrypt($value, $resault, $key)) {
                trace(openssl_error_string(), 'warning');
            }
            $value = base64_encode($resault);
        }
    }

    /**
     * 
     */
    public static function publicKeyDecrypt($path, &...$data) {
        $text = file_get_contents($path);
        $key = openssl_pkey_get_public($text);
        foreach($data as &$value) {
            $raw = base64_decode($value);
            if (!openssl_public_decrypt($raw, $value, $key)) {
                trace(openssl_error_string(), 'warning');
            }
        }
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
        return $text;
    }

    /**
     * 生成公钥。
     * 
     */
    public static function makePublicKey($key, $path=null) {
        $key = openssl_pkey_get_private($key);
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