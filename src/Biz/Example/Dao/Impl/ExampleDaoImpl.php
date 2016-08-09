<?php
namespace Biz\Example\Dao\Impl;

use Biz\Example\Dao\ExampleDao;
use Codeages\Biz\Framework\Dao\GeneralDaoImpl;

class ExampleDaoImpl extends GeneralDaoImpl implements ExampleDao
{
    protected $table = 'example';

    public function declares()
    {
        return array(
            'timestamps' => array('created', 'updated'),
            'serializes' => array('ids1' => 'json', 'ids2' => 'delimiter'),
            'conditions' => array(
                'name = :name',
            ),
        );
    }

}
