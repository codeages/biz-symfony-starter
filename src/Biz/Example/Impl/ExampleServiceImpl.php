<?php

namespace Biz\Example\Impl;

use Codeages\Biz\Framework\Service\BaseService;
use Biz\Example\ExampleService;

class ExampleServiceImpl extends BaseService implements ExampleService
{
    public function getExample($id)
    {
        return $this->getExampleDao()->get($id);
    }

    protected function getExampleDao()
    {
        return $this->biz['example_dao'];
    }
    
}