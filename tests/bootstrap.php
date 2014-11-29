<?php

error_reporting(E_ALL | E_STRICT);

// include the composer autoloader
file_put_contests(dirname(__FILE__).'/vars.txt',__DIR__,FILE_APPEND);

$autoloader = require __DIR__.'/../vendor/autoload.php';

// autoload abstract TestCase classes in test directory
$autoloader->add('Omnipay', __DIR__);
