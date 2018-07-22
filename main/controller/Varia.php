<?php namespace pluck\controller;

use think\Response;
use fi5e\facade\Crypt;

/**
 * 
 */
final class Varia extends Basic {
    /**
     * 输出 RSA 公钥。
     */
    public function proof() {
        $data = Crypt::exportPublicKey();
        return new Response($data, 200, [
            'Content-Type' => 'text/plain; charset=utf-8'
        ]);
    }
}