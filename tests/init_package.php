<?php

$loader = include __DIR__.'/../vendor/autoload.php';
$loader->addPsr4('Test\\', __DIR__.'/test_package_src/classes');

require __DIR__ . '/test_package_src/bootstrap.php';