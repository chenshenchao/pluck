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
        session('?admin') or abort(404);
        $pagination = Administrator::where(
            'priority', '>', session('admin.priority')
        )->paginate(3);
        return $this->fetch('index/administration', [
            'pagination' => $pagination,
        ]);
    }
}