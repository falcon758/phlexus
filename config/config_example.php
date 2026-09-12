<?php

declare(strict_types=1);

return [
    'company' => [
        'name'    => 'Phlexus',
        'address' => [
            'street'    => 'Street Address',
            'city'      => 'City',
            'post_code' => '11111'
        ],
        'email' => 'ltd@example.com'
    ],

    'application' => [
        'base_uri'   => '/',
        'upload_dir' => dirname(__DIR__) . '/public/assets/',
    ],

    'session' => [
        'session_name' => 'phlexus-app'
    ],

    'theme' => [
        'themes_dir'       => dirname(__DIR__) . '/themes/',
        'theme_user'       => 'phlexus-tabler-admin',
        'theme_public'     => '/assets/themes/',
    ],

    'paths' => [
        'themes' => dirname(__DIR__) . '/themes/',
        'models' => dirname(__DIR__) . '/src/Models/',
    ],

    'auth' => [
        'adapter' => 'model',
        'configurations' => [
            'model'  => \Phlexus\Modules\BaseUser\Models\User::class,
            'fields' => [
                'identity' => 'email',
                'password' => 'password',
                'id'       => 'id',
                'active'   => 'active',
            ],
            'login_redirect' => 'user',
        ],
        'exclude_routes' => [
            'Landing' => '*',
        ],
    ],

    'translations' => [
        'type'   => \Phlexus\Libraries\Translations\TranslationFactory::DATABASE,
        'config' => [
            'files_dir' => dirname(__DIR__) . '/translations',
            'default_language' => 'en-us',
        ],
    ],

    'communications' => [
        'email' => [
            'config' => [
                'is_smtp'  => true,
                'host'     => getenv('SMTP_HOST') ?: '',
                'name'     => getenv('SMTP_NAME') ?: '',
                'username' => getenv('SMTP_USERNAME') ?: '',
                'password' => getenv('SMTP_PASSWORD') ?: '',
                'port'     => getenv('SMTP_PORT') ?: '',
            ],
        ],

        'sms' => [
            'from' => getenv('SMS_FROM') ?: '',
            'config' => [
                'sid'   => getenv('TWILIO_SID') ?: '',
                'token' => getenv('TWILIO_TOKEN') ?: '',
            ],
        ],
    ],

    'oauth' => [
        'google' => [
            'client_id' => getenv('GOOGLE_CLIENT_ID') ?: '',
            'client_secret' => getenv('GOOGLE_CLIENT_SECRET') ?: '',
            'redirect_uri' => getenv('GOOGLE_REDIRECT_URI') ?: '',
            //'hosted_domain' => getenv('GOOGLE_HOSTED_DOMAIN') ?: '',
        ],
        'apple' => [
            'client_id' => getenv('APPLE_CLIENT_ID') ?: '',
            'team_id' => getenv('APPLE_TEAM_ID') ?: '',
            'key_id' => getenv('APPLE_KEY_ID') ?: '',
            'key_file_path' => getenv('APPLE_KEY_FILE_PATH') ?: '',
            'redirect_uri' => getenv('APPLE_REDIRECT_URI') ?: '',
        ],
    ],

    'payments' => [
        'stripe' => [
            'secret_key' => getenv('STRIPE_SECRET_KEY') ?: '',
        ],
    ],

    'modules' => [
        'Landing' => [
            'className' => \Phlexus\Modules\Landing\Module::class,
            'path'      => dirname(__DIR__) . '/src/Modules/Landing/Module.php',
            'router'    => dirname(__DIR__) . '/src/Modules/Landing/Config/routes.php',
        ],
    ],

    'view' => [
        'engines' => [
            '.phtml' => [
                'class' => \Phalcon\Mvc\View\Engine\Php::class,
            ],
            '.volt'  => [
                'class'   => \Phalcon\Mvc\View\Engine\Volt::class,
                'options' => [
                    'path' => dirname(__DIR__) . '/var/cache/',
                ],
            ],
        ],
    ],

    'db' => include_once 'database.php',

    'providers' => include_once 'providers.php',

    'security' => [
        'app_hash' => getenv('APP_HASH') ?: 'A_STRONG_HASH',
        'work_factor' => 14,
        'captcha' => [
            'config' => [
                'site-key' => getenv('CAPTCHA_SITE_KEY') ?: '',
                'secret'   => getenv('CAPTCHA_SECRET') ?: '',
            ],
        ],
    ],

    'cache' => [
        'redis' => [
            'config' => [
                'defaultSerializer' => 'Json',
                'lifetime'          => 7200,
                'host'              => getenv('REDIS_HOST') ?: 'localhost',
                'port'              => getenv('REDIS_PORT') ?: 6379,
                'index'             => 1,
            ],
        ],
    ],

    'events' => [],
];
