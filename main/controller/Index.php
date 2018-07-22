<?php namespace pluck\controller;

use pluck\model\Administrator;

/**
 * 后台页面
 * 
 * 
 */
final class Index extends Basic {
    /**
     * 主页。
     * 
     */
    public function index() {
        Administrator::isSigned() or abort(404);
        return $this->fetch('index/index');
    }

    /**
     * 登入页。
     * 
     */
    public function login() {
        Administrator::isSigned() and abort(404);
        return $this->fetch('index/login');
    }

    /**
     * 登出。
     * 
     */
    public function logout() {
        Administrator::isSigned() or abort(404);
        Administrator::signout();
        return $this->redirect('pluck-page', ['page' => 'login']);
    }
}