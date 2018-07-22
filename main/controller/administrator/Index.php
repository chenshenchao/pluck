<?php namespace pluck\controller\administrator;

use pluck\controller\Basic;
use pluck\model\Administrator;

/**
 * 管理员页面
 * 
 */
final class Index extends Basic {
    /**
     * 管理员页。
     * 
     */
    public function index() {
        return $this->fetch('administrator/index', []);
    }

    /**
     * 
     */
    public function add() {
        return $this->fetch('administrator/add', []);
    }

    /**
     * 
     */
    public function listing() {
        return $this->fetch('administrator/listing', []);
    }
}