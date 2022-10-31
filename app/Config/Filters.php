<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'login'         => \App\Filters\LoginFilter::class, //FIltro de login
        'admin'         => \App\Filters\AdminFilter::class, //FIltro de admin
        'visitante'     => \App\Filters\VisitanteFilter::class, //FIltro de visitante
        'throttle'     => \App\Filters\ThrottleFilter::class, //FIltro que ajuda a prevenir ataques de força bruta 


    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'csrf',
            // 'honeypot',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [

        'post' => ['throttle',]
    ];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [

        'login' => [
            'before' => [
                'admin/*', //quero que o filtro rode antes de todos os controladores que estão abaixo do namespace admin
                'Conta(/*)?',
                'Checkout(/*)?'
                
            ]
            ],

        'admin' => [
             'before' => [
                 'admin/*', //todos os controller que estão no namespace admin só serão acessados por um admin 
                ]
                ],
                
       





    ];
}
