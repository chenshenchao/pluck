<?php namespace pluck\widget;

/**
 * 
 */
final class Sidebar {
    private $items;

    /**
     * 
     */
    public function __construct() {
        $this->items = [
            'main' => [
                'text' => 'Main',
                'link' => pluck_link(),
                'children' => [
                    'info' => [
                        'text' => 'Info',
                        'link' => pluck_link(),
                    ],
                    'administartor' => [
                        'text' => 'Administartor',
                        'link' => pluck_link('administartor'),
                    ]
                ]
            ],
            'archive' => [
                'text' => 'Archive',
                'link' => pluck_link('archive'),
                'children' => [
                    'new' => [
                        'text' => 'New',
                        'link' => pluck_link('archive/new'),
                    ]
                ]
            ]
        ];
    }

    /**
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