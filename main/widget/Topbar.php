<?php namespace pluck\widget;

use think\facade\Config;

/**
 * 后台顶部栏
 * 
 */
final class Topbar {
    use Setting;

    /**
     * 
     */
    public function __construct() {
        $this->setting = Config::get('pluck.topbar');
    }

    /**
     * 
     */
    public function getBrand() {
        return $this->setting['brand'];
    }

    /**
     * 
     */
    public function getLeftItems() {
        return $this->setting['left'];
    }

    /**
     * 
     */
    public function getRightItems() {
        return $this->setting['right'];
    }
}