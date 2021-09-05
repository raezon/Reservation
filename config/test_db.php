<?php

return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host='.$_ENV['DB_HOST'].';port='.$_ENV['DB_PORT'].';dbname='.'clicangodb_test',
        'username' => 'root',
        'password' => '',
        'charset' => $_ENV['DB_CHARSET'],

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
