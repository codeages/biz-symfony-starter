<?php
namespace Biz;

use Codeages\Biz\Framework\Context\Kernel;

class BizKernel extends Kernel
{
    public function boot($options = array())
    {
        $this->registerService();
        $this->put('migration_directories', dirname(dirname(__DIR__)). '/migrations');
        parent::boot();
    }

    public function registerProviders()
    {
        return [];
    }

    protected function registerService()
    {
        $this['example_dao'] = $this->dao(function($container) {
            return new Example\Dao\Impl\ExampleDaoImpl($container);
        });

        $this['example_service'] = function($container) {
            return new Example\Impl\ExampleServiceImpl($container);
        };
    }
}