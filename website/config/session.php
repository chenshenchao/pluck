<?php return [
    // session name
    'name'           => '',
    // SESSION_ID的提交变量,解决flash上传跨域
    'var_session_id' => '',
    // 驱动方式 支持file redis memcache memcached
    'type'           => 'file',
    // 过期时间
    'expire'         => 0,
    // 前缀
    'prefix'         => '',
];
