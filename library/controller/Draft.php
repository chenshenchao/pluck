<?php namespace pluck\controller;

/**
 * 
 */
final class Draft extends Basic {
    /**
     * 
     */
    public function index() {
        return $this->fetch('archive/index');
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