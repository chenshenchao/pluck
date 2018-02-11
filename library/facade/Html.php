<?php namespace pluck\facade;

use think\Facade;

/**
 * 
 */
final class Html extends Facade {
    /**
     * 内联样式。
     * 
     * @param string $path: 样式文件路径。
     */
    public static function inlineStyle($path) {
        $code = file_get_contents($path);
        return "<style>$code</style>";
    }

    /**
     * 内联脚本。
     * 
     * @param string $path: 脚本文件路径。
     */
    public static function inlineScript($path) {
        $code = file_get_contents($path);
        return '<script type="text/javascript">'.$code.'</script>';
    }

    /**
     * 把图片内嵌成 base64
     * 
     * @param string $path: 图片路径。
     */
    public static function base64Image($path) {
        $suffix = pathinfo($path, PATHINFO_EXTENSION);
        $raw = file_get_contents($path);
        $text = base64_encode($raw);
        return "data:image/$suffix;base64,$text";
    }
}