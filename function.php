<?php
/*****************************************************************************
 * Pluck 函数定义
 * 
 * Pluck 提供全局的扩展函数定义在此。
 *****************************************************************************/

/**
 * 获取路径。
 * 
 * @param string $name: 储备的路径名。
 * @param string... $tail: 后续的路径。
 * @return string: 生成的路径。
 */
if (!function_exists('pathof')) {
    function pathof($name, ...$tail) {
        return Path::of($name, ...$tail);
    }
}

/**
 * 生成后台链接。
 * 
 */
if (!function_exists('pluck_link')) {
    function pluck_link($tail=null) {
        $head = '/'.config('pluck.link');
        return isset($tail) ? "$head/$tail" : $head;
    }
}