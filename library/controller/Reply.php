<?php namespace pluck\controller;

use pluck\Controller;
use pluck\facade\Path;
use pluck\facade\Crypt;
use pluck\model\Administrator;

/**
 * 回应
 * 
 * 回应后台各种 Post 请求。
 */
final class Reply extends Controller {
    /**
     * 
     */
    public function checkin() {
        $post = request()->post();
        $account = $post['username'];
        $password = $post['password'];
        $captcha = $post['captcha'];
        $path = Path::of('runtime', 'private.key');
        Crypt::decrypt($path, $account, $password, $captcha);
        if(!captcha_check($captcha)) {
            return ['tip' => 'captcha error.'];
        }
        $admin = Administrator::checkin($account, $password);
        if(!isset($admin)) {
            return ['tip' => 'invailed username or password.'];
        }
        $admin->signin('admin');
        return ['target' => pluck_link()];
    }
}