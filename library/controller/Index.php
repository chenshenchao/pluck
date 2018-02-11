<?php namespace pluck\controller;

use pluck\facade\Sidebar;
use pluck\model\Administrator;

/**
 * 后台页面
 * 
 * 
 */
final class Index extends Basic {
    /**
     * 
     */
    public function index() {
        session('?admin') or abort(404);
        $all = Administrator::all();
        return $this->fetch('index/index', []);
    }

    /**
     * 登入页面。
     * 
     */
    public function login() {
        session('?admin') and abort(404);
        return $this->fetch('login');
    }

    /**
     * 登出。
     * 
     */
    public function logout() {
        session('?admin') or abort(404);
        session('admin', null);
        return $this->redirect('/');
    }

    /**
     * 管理页。
     * 
     */
    public function administration() {
        session('?admin') or abort(404);
        return $this->fetch('index/administration');
    }

    /**
     * 管理员页。
     * 
     */
    public function administrator() {
        session('?admin') or abort(404);
        $all = Administrator::all();
        return $this->fetch('index/administrator', [
            'administrators' => $all,
        ]);
    }
}