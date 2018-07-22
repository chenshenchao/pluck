<?php namespace pluck;

use think\template\TagLib;

/**
 * 
 */
class One extends TagLib {
    protected $tags = [
        'dataurl' => [
            'close' => 0,
        ]
    ];

    public function tagDataurl() {
        return 'aaaa';
    }
}