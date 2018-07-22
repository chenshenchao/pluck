<?php namespace pluck\model;

use think\Db;
use think\Model;

/**
 * 管理员模型
 * 
 */
final class Administrator extends Model {
    public const SUPER_ID = 100000000;
    public const SESSION_ID = 'admin';

    /**
     * 登入。
     * 
     * @param string $account: 账户。
     * @param string $password: 密码。
     * @return mixed: 模型实例。
     */
    public static function login($account, $password) {
        $admin = self::field([
            'id', 'nickname',
            'UNIX_TIMESTAMP(signdate)' => 'signdate',
            'UNIX_TIMESTAMP(logintime)' => 'logintime',
        ])->where('account', '=', $account)
        ->where('password', 'exp', "=UNHEX(SHA2('$password', 256))")
        ->find();
        if (is_null($admin)) return $admin;

        self::signin($admin);
        return $admin;
    }

    /**
     * 是否登入。
     * 
     */
    public static function isSigned() {
        return session('?'.self::SESSION_ID);
    }

    /**
     * 获取目前登入的管理员信息。
     * 
     */
    public static function getSign() {
        return session(self::SESSION_ID);
    }

    /**
     * 登入。
     * 
     */
    public static function signin($admin) {
        $now = time();
        $admin->logintime = date('Y-m-d h:i:s', $now);
        $admin->save();
        session(self::SESSION_ID, [
            'id' => $admin->id,
            'nickname' => $admin->name,
            'signdate' => $admin->signdate,
            'logintime' => $now,
            'key' => md5(time().mt_rand(0,10000))
        ]);
    }

    /**
     * 登出。
     * 
     */
    public static function signout() {
        session(self::SESSION_ID, null);
    }

    /**
     * 添加管理员。
     * 
     * @param string $account: 账户。
     * @param string $password: 密码。
     * @param string[option] $nickname: 名。
     * @return mixed: 模型实例。
     */
    public static function add($account, $password, $nickname=null) {
        return self::create([
            'nickname' => $nickname ?? 'Administrator',
            'account' => $account,
            'password' => Db::raw("UNHEX(SHA2('$password',256))"),
            'priority' => $priority,
        ]);
    }
}