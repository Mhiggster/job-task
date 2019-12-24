<?php

return [
    'driver' => 'mysql',
    'host' => 'mysql',
    'username' => 'root',
    'password' => '123qwe123qwe',
    'dbname' => 'choco',
    'options' => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]
];