<?php

$currencies="$";
return [
    'adminEmail' => $_ENV['PARAMS_ADMIN_EMAIL'],
    'senderEmail' => $_ENV['PARAMS_SENDER_EMAIL'],
    'senderName' => $_ENV['PARAMS_SENDER_NAME'],
    'POWERED_BY' => 'ClicandgoEvent',
    'bsVersion' => '3.x', // for kartik extensions
    'maskMoneyOptions' => [
        'prefix' => $currencies,
        'suffix' => '',
        'affixesStay' => true,
        'thousands' => ',',
        'decimal' => '.',
        'precision' => 2, 
        'allowZero' => false,
        'allowNegative' => false,
        'aliases' => [
        '@foo' => '/path/to/foo',
        '@bar' => 'http://www.example.com',
        'productImgPath'=>'C:\xampp\htdocs\clicangoevent\mainrepo\web\img\products',
        'productImgUrl'=>'http://localhost/clicangoevent/mainrepo/web/img/products/'
    ],
    ]
];
