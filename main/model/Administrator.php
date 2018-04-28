<?php namespace pluck\model;

use think\Model;

/**
 * 管理员模型
 * 
 */
final class Administrator extends Model {
    /**
     * 检入。
     * 
     * @param string $account: 账户。
     * @param string $password: 密码。
     * @return mixed: 模型实例。
     */
    public static function checkin($account, $password) {
        return self::where('account', '=', $account)
            ->where('password', 'exp', "=UNHEX(MD5('$password'))")
            ->find();
    }

    /**
     * 
     */
    public static function login($account, $cipher) {
        $admin = self::where('account', '=', $account)
            ->where('password', 'exp', "=UNHEX(MD5('$cipher'))")
            ->find();
        if (is_null($admin)) return false;

        $admin->logintime = date('Y-m-d h:i:s');
        $admin->save();
        $admin->signin('admin');
        return true;
    }

    /**
     * 添加管理员。
     * 
     * @param string $account: 账户。
     * @param string $password: 密码。
     * @param string[option] $name: 名。
     * @return mixed: 模型实例。
     */
    public static function add($account, $password, $name=null, $priority=7) {
        return self::create([
            'name' => $name ?? 'Administrator',
            'account' => $account,
            'password' => ['exp', "UNHEX(MD5('$password'))"],
            'priority' => $priority,
        ]);
    }

    /**
     * 登录，把信息写入会话。
     * 
     * @param string $name: 会话名。
     */
    public function signin($name) {
        session($name, [
            'id' => $this->id,
            'name' => $this->name,
            'priority' => $this->priority,
            'signdate' => $this->signdate,
            'logintime' => $this->logintime,
            'key' => md5(time().mt_rand(0,10000))
        ]);
    }
}