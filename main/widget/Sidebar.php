<?php namespace pluck\widget;

/**
 * 后台侧边栏
 * 
 */
final class Sidebar {
    private $items;

    /**
     * 初始化。
     * 
     */
    public function __construct() {
        $this->items = [
            // 主要菜单
            'main' => [
                'text' => 'Main',
                'link' => pluck_link(),
                'children' => [
                    'configuration' => [
                        'text' => 'Configuration',
                        'link' => pluck_link('configuration'),
                    ],
                    'administration' => [
                        'text' => 'Administration',
                        'link' => pluck_link('administration'),
                    ]
                ]
            ],
            // 文章菜单
            'archive' => [
                'text' => 'Archive',
                'link' => pluck_link('archive'),
                'children' => [
                    'new' => [
                        'text' => 'New',
                        'link' => pluck_link('archive/new'),
                    ],
                    'trash' => [
                        'text' => 'Trash',
                        'link' => pluck_link('archive/trash'),
                    ]
                ]
            ]
        ];
    }

    /**
     * 获取菜单项。
     * 
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * 使得项标记为活跃。
     * 
     * @param string $one: 一级项名。
     * @param string[option] $two: 二级项名。
     * @param string[option] $able: 是否有效，默认 true，通过设置 false 来使得项不活跃。
     */
    public function activate($one, $two=null, $able=true) {
        if (array_key_exists($one, $this->items)) {
            $item = &$this->items[$one];
            $item['active'] = $able;
            if (isset($two) and array_key_exists('children', $item)) {
                $children = &$item['children'];
                if (array_key_exists($two, $children)) {
                    $children[$two]['active'] = $able;
                }
            }
        }
    }
}