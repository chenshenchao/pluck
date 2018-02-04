<?php
/*****************************************************************************
 * Pluck 函数定义
 * 
 * Pluck 提供全局的扩展函数定义在此。
 *****************************************************************************/
use pluck\Path;

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