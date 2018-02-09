<?php namespace pluck\utility;

/**
 * 路径
 * 
 * 提供路径处理的方法和获取默认路径。
 */
final class Path {
    private $reservation;       // 储备路径

    /**
     * 初始化默认路径。
     * - public 服务器根目录（即 TP5 的 index.php 目录）
     * - root 项目根目录（即 TP5 项目的目录）
     */
    public function __construct() {
        $public = realpath(null);
        $root = dirname($public);
        $this->reservation = [
            'root' => $root,
            'public' => $public,
            'config' => $root.\Path::DS.'config',
            'extend' => $root.\Path::DS.'extend',
            'runtime' => $root.\Path::DS.'runtime',
            'route' => $root.\Path::DS.'route',
            'application' => $root.\Path::DS.'application',
        ];
    }

    /**
     * 获取路径。
     * 
     * @param string $name: 储备的路径名。
     * @param string... $tail: 后续的路径。
     * @return string: 生成的路径。
     */
    public function of($name, ...$tail) {
        $head = $this->reservation[$name];
        return \Path::join($head, ...$tail);
    }

    /**
     * 储备路径。
     * 
     * @param string $name: 储备的路径名。
     * @param string $path: 储备的路径。
     */
    public function let($name, $path) {
        $this->reservation[$name] = $path;
    }
}