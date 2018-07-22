<?php namespace pluck\widget;

use think\facade\Config;

/**
 * 后台侧边栏
 * 
 */
final class Sidebar {
    use Setting;

    /**
     * 初始化。
     * 
     */
    public function __construct() {
        $this->setting = Config::get('pluck.sidebar');
    }

    /**
     * 获取菜单项。
     * 
     */
    public function getItems() {
        self::sortItems($this->setting['menu']);
        return $this->setting['menu'];
    }

    /**
     * 菜单排序。
     * 
     */
    private static function sortItems(&$target) {
        uasort($target, function($a, $b) {
            $ao = $a['order'] ?? 0;
            $bo = $b['order'] ?? 0;
            if ($ao === $bo) return 0;
            return $ao > $bo ? -1 : 1;
        });
        foreach ($target as $key => &$value) {
            if (isset($value['children'])) {
                self::sortItems($value['children']);
            }
        }
    }
}