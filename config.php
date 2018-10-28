<?php
// Defines the configurations for API

//user config for authentication
$rest_username = 'testuser';
$rest_password = 'testp@ssw0rd';


//Db config
//local
$db = [
    'host' => 'localhost',
    'port' => '3306',
    'user' => 'root',
    'password' => 'tiger',
    'database' => 'dbapi',
];
//live
$db = [
    'host' => 'localhost',
    'port' => '3306',
    'user' => 'dbapiuser',
    'password' => '5f4#nP928WP',
    'database' => 'dbapi',
];

//TODO: For Future Implementation
//resource request limits
$callLimits = [
    //resource => limit per min
    'client' => 60,
    'employee' => 60,
];
