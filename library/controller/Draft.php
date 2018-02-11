<?php namespace pluck\controller;

use pluck\model\Archive;

/**
 * 
 */
final class Draft extends Basic {
    /**
     * 
     */
    public function index() {
        session('?admin') or abort(404);
        $all = Archive::all();
        return $this->fetch('archive/index', [
            'archives' => $all,
        ]);
    }

    /**
     * 
     */
    public function create() {
        return $this->fetch('archive/new');
    }

    /**
     * 
     */
    public function edit($id) {
        return $this->fetch('archive/edit');
    }

    /**
     * 
     */
    public function load() {

    }

    /**
     * 
     */
    public function save() {

    }
}