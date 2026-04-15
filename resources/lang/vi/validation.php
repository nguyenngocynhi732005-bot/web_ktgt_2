<?php

return [
    'custom' => [
        'email' => [
            'unique' => 'Email này đã được sử dụng.',
        ],

        'password' => [
            'confirmed' => 'Xác nhận mật khẩu không khớp.',
            'min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ],
    ],

    'attributes' => [
        'email' => 'email',
        'password' => 'mật khẩu',
    ],
];
