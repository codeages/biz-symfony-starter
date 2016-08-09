<?php

use Codeages\Biz\Framework\Dao\MigrationBootstrap;
use Symfony\Component\Console\Input\ArgvInput;

$input = new ArgvInput();
$env = $input->getParameterOption(array('--env', '-e'), getenv('SYMFONY_ENV') ?: 'dev');

$kernel = new AppKernel($env, true);
$kernel->boot();

$biz = $kernel->getContainer()->get('biz');

$migration = new MigrationBootstrap($biz);
return $migration->boot();