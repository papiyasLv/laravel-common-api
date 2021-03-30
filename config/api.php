<?php


return [
    'settings' => [
        'status_key' => 'status',
        'message_key' => 'message',
        'data_result_key' => 'data',

        'message_always_return' => false,
    ],


//    可以通过设置回调函数给接口添加额外的统一返回值
//    'callback' => function ($json) {
//        $json['time'] = time();
//        return $json;
//    },

    'callback' => null,
];
