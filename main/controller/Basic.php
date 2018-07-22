<?php namespace pluck\controller;

use think\Controller;
use think\facade\Lang;
use fi5e\facade\Path;
use pluck\One;

/**
 * Pluck 控制器
 * 
 * 扩展了 ThinkPHP 的控制器，提供一些定制。
 */
abstract class Basic extends Controller {
    /**
     * 初始化
     * - 把模板定位到 template 目录。
     * - 选择语言并载入相应的词典。
     */
    public function __construct() {
        parent::__construct();
        $this->engine([
            'view_base' => Path::of('pluck', 'view', ''),
            'taglib_pre_load' => One::class,
        ]);
        $lexicon = Lang::range().'.php';
        Lang::load(Path::of('pluck', 'lang', $lexicon));
    }
}