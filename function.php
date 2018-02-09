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
 * 内联样式。
 * 
 * @param string $path: 样式文件路径。
 */
if (!function_exists('inline_style')) {
    function inline_style($path) {
        $code = file_get_contents($path);
        return "<style>$code</style>";
    }
}

/**
 * 内联脚本。
 * 
 * @param string $path: 脚本文件路径。
 */
if (!function_exists('inline_script')) {
    function inline_script($path) {
        $code = file_get_contents($path);
        return '<script type="text/javascript">'.$code.'</script>';
    }
}

/**
 * 把图片内嵌成 base64
 * 
 * @param string $path: 图片路径。
 */
if (!function_exists('base64_image')) {
    function base64_image($path) {
        $suffix = pathinfo($path, PATHINFO_EXTENSION);
        $raw = file_get_contents($path);
        $text = base64_encode($raw);
        return "data:image/$suffix;base64,$text";
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