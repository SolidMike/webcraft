<?php

return [
    // MainController
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    // UserController
    'login' => [
        'controller' => 'user',
        'action' => 'login',
    ],
    'register' => [
        'controller' => 'user',
        'action' => 'register',
    ],
    'show' => [
        'controller' => 'user',
        'action' => 'show',
    ],
    'token' => [
        'controller' => 'user',
        'action' => 'token'
    ],
    'confirm/{activation:\w+}' => [
        'controller' => 'user',
        'action' => 'confirm',
    ],
    'api/{apikey:\w+}' => [
      'controller' => 'user',
      'action' => 'api',
    ],
];