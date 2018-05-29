<?php

return [
    // MainController
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'main/post/{page:\d+}' => [
        'controller' => 'main',
        'action' => 'post',
    ],

    'about' => [
        'controller' => 'main',
        'action' => 'about',
    ],

    'contact' => [
        'controller' => 'main',
        'action' => 'contact',
    ],

    'post' => [
        'controller' => 'main',
        'action' => 'post',
    ],

    'portfolio' => [
        'controller' => 'main',
        'action' => 'portfolio',
    ],

    'postitem' => [
        'controller' => 'main',
        'action' => 'postitem',
    ],

    'postitem/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'postitem',
    ],
    // AdminController
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],
    'admin/add' => [
        'controller' => 'admin',
        'action' => 'add',
    ],
    'admin/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],
    'admin/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'delete',
    ],
    'admin/posts/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'posts',
    ],
    'admin/posts' => [
        'controller' => 'admin',
        'action' => 'posts',
    ],
    // AccountController

    'account/registration' => [
        'controller' => 'account',
        'action' => 'registration',
    ],
    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],
    'account/activate/{token:\w+}' => [
        'controller' => 'account',
        'action' => 'activate',
    ],

    'account/recovery' => [
        'controller' => 'account',
        'action' => 'recovery',
    ],

    'account/profile' => [
        'controller' => 'account',
        'action' => 'profile',
    ],

    'account/logout' => [
        'controller' => 'account',
        'action' => 'logout',
    ],

    'account/reset/{token:\w+}' => [
        'controller' => 'account',
        'action' => 'reset',
    ],

];