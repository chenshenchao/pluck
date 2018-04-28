<?php namespace pluck\facade;

use think\Facade;

/**
 * 
 */
final class Sidebar extends Facade {
    /**
     * 
     */
    public static function getFacadeClass() {
        return 'pluck\widget\Sidebar';
    }
}