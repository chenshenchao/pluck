<?php namespace pluck\controller;

use fi5e\facade\Path;
use fi5e\facade\Crypt;
use pluck\model\Variant;

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
        Crypt::decrypt($account, $password, $captcha);
        if(!captcha_check($captcha)) {
            return json([
                'tip' => lang('captcha error.'),
                'captcha' => $captcha,
            ], 400);
        }
        $admin = Administrator::checkin($account, $password);
        if(!isset($admin)) {
            return json([
                'tip' => lang('invailed username or password.')
            ], 400);
        }
        $admin->logintime = date('Y-m-d h:i:s');
        $admin->save();
        $admin->signin('admin');
        return ['target' => pluck_link()];
    }

    /**
     * 增加变量。
     * 
     */
    public function addVariant() {
        session('?admin') or abort(404);
        $post = request()->post();
        $name = $post['name'];
        $value = $post['value'];
        Crypt::decrypt($name, $value);
        try {
            $variant = new Variant;
            $variant->save([
                'name' => $name,
                'value' => $value,
            ]);
            return ['target' => pluck_link('configuration')];
        }
        catch (\Excepation $e) {
            return json([
                'tip' => $e->getMessage()
            ], 400);
        }
    }
    
    /**
     * 修改变量。
     * 
     */
    public function amendVariant() {
        session('?admin') or abort(404);
        $post = request()->post();
        $id = $post['id'];
        $name = $post['name'];
        $value = $post['value'];
        Crypt::decrypt($id, $name, $value);
        try {
            $variant = Variant::get(['id' => $id]);
            $variant->save([
                'name' => $name,
                'value' => $value,
            ]);
            return ['target' => pluck_link('configuration')];
        }
        catch (\Excepation $e) {
            return json([
                'tip' => $e->getMessage()
            ], 400);
        }
    }
}