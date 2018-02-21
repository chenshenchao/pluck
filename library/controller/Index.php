<?php namespace pluck\controller;

use pluck\facade\Sidebar;
use pluck\model\Variant;
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
    public function configure() {
        session('?admin') or abort(404);
        $pagination = Variant::where([

        ])->paginate(7);
        return $this->fetch('index/configuration', [
            'pagination' => $pagination
        ]);
    }

    /**
     * 管理员页。
     * 
     */
    public function administrate() {
        session('?admin') or abort(404);
        $pagination = Administrator::where(
            'priority', '>', session('admin.priority')
        )->paginate(3);
        return $this->fetch('index/administration', [
            'pagination' => $pagination,
        ]);
    }
}