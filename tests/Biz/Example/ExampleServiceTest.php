<?php

use Codeages\Biz\Framework\UnitTests\BaseTestCase;

class ExampleServiceTest extends BaseTestCase
{
    public function testGetExample()
    {
        $example = $this->getExampleService()->getExample(1);
        $this->assertNull($example);
    }

    protected function getExampleService()
    {
        return self::$kernel['example_service'];
    }

}