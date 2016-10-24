<?php

use Biz\BizKernel;
use Worker\AbstractWorker;

$root = dirname(__DIR__);
$env = getenv('ENV') ? : 'dev';

require $root . '/vendor/autoload.php';

$kernel = new AppKernel($env, true);
$kernel->boot();

$biz = $kernel->getContainer()->get('biz');

AbstractWorker::setBizKernel($biz);