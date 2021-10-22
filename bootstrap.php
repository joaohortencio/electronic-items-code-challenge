<?php

define("APP_PATH", __DIR__);
define("TESTS_PATH", __DIR__ . '/tests/');

$loader = require __DIR__ . '/vendor/autoload.php';
$loader->addPsr4('App\\', __DIR__ . '/src/');