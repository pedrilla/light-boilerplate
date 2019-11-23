<?php

/**
 * Run >php cli.php route="index/index" param1="value1" param2="value2"
 */

require_once __DIR__ . '/vendor/autoload.php';

echo \Light\Front::getInstance(require_once 'config.php')
    ->bootstrap()
    ->run();