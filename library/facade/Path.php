<?php namespace pluck\facade;

use think\Facade;

/**
 * Path 的 Facade
 * 
 * 提供了几个静态方法。
 */
final class Path extends Facade {
    // 路径分隔符
    public const DS = DIRECTORY_SEPARATOR;

    /**
     * 合并路径。
     * 
     * @param string... $path: 路径各部分。
     * @return string: 生成的路径。
     */
    public static function join(...$path) {
        return join(self::DS, $path);
    }

    /**
     * 合并并验证真实路径。
     * 
     * @param string... $path: 路径各部分。
     * @return string: 生成的路径。
     */
    public static function realize(...$path) {
        return realpath(join(self::DS, $path));
    }
}