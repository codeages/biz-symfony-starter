<?php

use Phpmig\Migration\Migration;

/**
 *
 */
class Init extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $container = $this->getContainer();
        $table = new Doctrine\DBAL\Schema\Table('example');
        $table->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement'=> true));
        $table->addColumn('name', 'string', array('length' => 64, 'null' => false, 'comment' => '名称'));
        $table->addColumn('ids1', 'text', array('null' => true, 'comment' => ''));
        $table->addColumn('ids2', 'text', array('null' => true, 'comment' => ''));
        $table->addColumn('updated', 'integer', array('default' => 0, 'signed' => true));
        $table->addColumn('created', 'integer', array('default' => 0, 'signed' => true));
        $table->setPrimaryKey(array('id'));
        $container['db']->getSchemaManager()->createTable($table);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $container = $this->getContainer();
        $container['db']->getSchemaManager()->dropTable('example');
    }
}
