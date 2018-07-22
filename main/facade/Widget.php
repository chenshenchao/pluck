<?php namespace pluck\facade;

use think\Facade;

/**
 * 
 */
abstract class Widget extends Facade {
    /**
     * 
     */
    public static function getFacadeClass() {
        return str_replace('facade', 'widget', static::class);
    }
}