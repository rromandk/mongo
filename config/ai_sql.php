<?php

return [
    'allowed_tables' => [
        'users' => ['id', 'name', 'email', 'created_at'],
        'posts' => ['id', 'user_id', 'title', 'content'],
    ],

    'forbidden_tables' => [
        'password_reset_tokens',
        'migrations',
    ],

    'max_limit' => 100,
];