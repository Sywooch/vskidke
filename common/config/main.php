<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mail.ru',
                'username' => 'lycifer31992@mail.ru',
                'password' => 'lycifer30303',
                'port'     => 465,
                'encryption' => 'ssl',
            ],
        ],
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD'
        ],
        'sphinx' => [
            'class' => 'yii\sphinx\Connection',
            'dsn' => 'mysql:host=localhost;port=9306;',
            'username' => 'vskidki_vskidke',
            'password' => '0SSXsgFhFx',
        ],
    ],
];
