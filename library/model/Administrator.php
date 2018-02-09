<?php namespace pluck\model;

use think\Model;

/**
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
     * 添加管理员。
     * 
     * @param string $account: 账户。
     * @param string $password: 密码。
     * @param string[option] $name: 名。
     * @return mixed: 模型实例。
     */
    public static function add($account, $password, $name=null) {
        return self::create([
            'name' => $name ?? 'Administrator',
            'account' => $account,
            'password' => ['exp', "UNHEX(MD5('$password'))"]
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
            'signdate' => $this->signdate,
            'logintime' => $this->logintime
        ]);
    }
}