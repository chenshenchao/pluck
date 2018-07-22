<?php namespace pluck\controller;

use fi5e\facade\Path;
use fi5e\facade\Crypt;
use pluck\model\Administrator;

/**
 * 回应
 * 
 * 回应后台各种 Post 请求。
 */
final class Reply extends Basic {
    /**
     * 检入管理员。
     * 
     */
    public function login() {
        $post = Crypt::decrypt(request()->post());
        $account = $post['username'];
        $password = $post['password'];
        $captcha = $post['captcha'];
        if(!captcha_check($captcha)) {
            return json([
                'tip' => lang('_invailed_captcha_'),
                'captcha' => $captcha,
            ], 400);
        }
        $admin = Administrator::login($account, $password);
        if(!isset($admin)) {
            return json([
                'tip' => lang('_invailed_username_or_password_')
            ], 400);
        }
        return ['target' => url('pluck-page', ['page' => 'index'])];
    }
}