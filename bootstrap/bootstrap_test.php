<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;
use Codeages\Biz\Framework\UnitTests\UnitTestsBootstrap;

$loader = require __DIR__.'/../app/autoload.php';

$kernel = new AppKernel('test', true);
$kernel->boot();

$biz = $kernel->getContainer()->get('biz');

$bootstrap = new UnitTestsBootstrap($biz);
$bootstrap->boot();