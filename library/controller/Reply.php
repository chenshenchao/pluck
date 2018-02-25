<?php namespace pluck\controller;

use pluck\facade\Path;
use pluck\facade\Crypt;
use pluck\model\Variant;
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
        Crypt::decrypt($account, $password, $captcha);
        if(!captcha_check($captcha)) {
            return json([
                'tip' => lang('captcha error.')
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
        Crypt::decrypt($account, $password, $priority, $name);
        try {
            $administrator = new Administrator;
            $administrator->save([
                'name' => $name ?? 'Administrator',
                'account' => $account,
                'password' => ['exp', "UNHEX(MD5('$password'))"],
                'priority' => $priority,
            ]);
            return ['target' => pluck_link('administration')];
        } catch (\Exception $e){
            return json([
                'tip' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * 修改管理员。
     * 
     */
    public function amendAdministrator() {
        session('?admin') or abort(404);
        $post = request()->post();
        $password = $post['password'];
        $priority = $post['priority'];
        $name = $post['name'];
        $id = $post['id'];
        Crypt::decrypt($password, $priority, $name, $id);
        // 优先级不可高于当前管理员。
        if (session('admin.priority') > $priority) {
            return json([
                'tip' => lang('insufficient privilege.')
            ], 400);
        }
        try {
            $administrator = Administrator::get(['id' => $id]);
            if (!isset($administrator)) {
                return json([
                    'tip' => lang('invalid id.')
                ], 400);
            }
            // 不可越级修改管理员。
            if (session('admin.id') != $id and session('admin.priority') >= $administrator->priority) {
                return json([
                    'tip' => lang('priviliege invalid.')
                ], 400);
            }
            $administrator->save([
                'name' => $name,
                'password' => ['exp', "UNHEX(MD5('$password'))"],
                'priority' => $priority,
            ]);
            return ['target' => pluck_link('administration')];
        } catch (\Exception $e){
            return json([
                'tip' => $e->getMessage()
            ], 400);
        }
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