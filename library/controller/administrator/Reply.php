<?php namespace pluck\controller\administrator;

use fi5e\facade\Crypt;
use pluck\controller\Basic;
use pluck\model\Administrator;

/**
 * 管理员响应。
 * 
 */
final class Reply extends Basic {
    /**
     * 添加管理员。
     * 
     */
    public function append() {
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
     * 修改管理员信息。
     * 
     */
    public function amend() {
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
}