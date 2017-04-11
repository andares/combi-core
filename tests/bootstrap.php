<?php

use Combi\Facades\Runtime as rt;
use Combi\Facades\Tris as tris;
use Combi\Facades\Helper as helper;
use Combi\Package as core;
use Combi\Package as inner;
use Combi\Core\Abort as abort;

// set temp dir & init nette tester
define('TEMP_DIR', __DIR__ . '/tmp/' . getmypid());
require __DIR__ . '/init_tester.php';

// init combi
const TESTING = true;
rt::ready('core', [
	'scene'     => 'default',
    'is_prod'   => false,

    'path'      => [
        'tmp'   => TEMP_DIR . '/tmp',
        'logs'  => __DIR__ . '/logs',
        'docs'  => TEMP_DIR . '/docs',
        'tests' => TEMP_DIR . '/tests',
    ],
]);

// 补包
class TestPackage extends \Combi\Facades\Package
{
    protected static $pid = 'test';
}
rt::register(TestPackage::instance(__DIR__ . '/test_package_src'),
    'helpers')
        ->ready('test');
