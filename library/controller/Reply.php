<?php namespace pluck\controller;

use pluck\facade\Path;
use pluck\facade\Crypt;
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
    public function checkin() {
        $post = request()->post();
        $account = $post['username'];
        $password = $post['password'];
        $captcha = $post['captcha'];
        $path = Path::of('runtime', 'private.key');
        Crypt::decrypt($path, $account, $password, $captcha);
        if(!captcha_check($captcha)) {
            return ['tip' => lang('captcha error.')];
        }
        $admin = Administrator::checkin($account, $password);
        if(!isset($admin)) {
            return ['tip' => lang('invailed username or password.')];
        }
        $admin->logintime = date('Y-m-d h:i:s');
        $admin->save();
        $admin->signin('admin');
        return ['target' => pluck_link()];
    }

    /**
     * 添加管理员。
     * 
     */
    public function addAdministrator() {
        session('?admin') or abort(404);
        $post = request()->post();
        $account = $post['account'];
        $password = $post['password'];
        $priority = $post['priority'];
        $name = $post['name'];
        $path = Path::of('runtime', 'private.key');
        Crypt::decrypt($path, $account, $password, $priority, $name);
        try {
            $administrator = new Administrator;
            $administrator->save([
                'name' => $name ?? 'Administrator',
                'account' => $account,
                'password' => ['exp', "UNHEX(MD5('$password'))"],
                'priority' => $priority,
            ]);
            return ['target' => pluck_link('administrator')];
        } catch (\Exception $e){
            return [
                'tip' => $e->getMessage()
            ];
        }
    }
}