<?php namespace pluck\controller;

use pluck\Controller;

/**
 * 后台页面
 * 
 * 
 */
final class Index extends Controller {
    /**
     * 
     */
    public function index() {
        session('?admin') or abort(404);
        return $this->fetch('layout');
    }

    /**
     * 
     */
    public function login() {
        session('?admin') and abort(404);
        return $this->fetch('login');
    }

    /**
     * 
     */
    public function logout() {
        session('?admin') or abort(404);
        session('admin', null);
        return $this->fetch('logout');
    }
}