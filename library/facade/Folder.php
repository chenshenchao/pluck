<?php namespace pluck\facade;

use think\Facade;

/**
 * 文件夹
 * 
 * 提供文件和目录的扩展方法。
 */
final class Folder extends Facade {
    /**
     * 复制文件夹。
     * 
     * @param string $source: 源路径。
     * @param string $target: 目标路径。
     * @param string[option] $recursive: 是否递归复制，默认为是。
     */
    public static function copy($source, $target, $recursive=true) {
        $directory = opendir($source);
        is_dir($target) or mkdir($target);
        while (false !== ($name = readdir($directory))) {
            if ('.' == $name || '..' == $name) continue;
            $childSource = Path::join($source, $name);
            $childTarget = Path::join($target, $name);
            if (is_file($childSource)) copy($childSource, $childTarget);
            elseif ($recursive) self::copy($childSource, $childTarget);
        }
        closedir($directory);
    }
}