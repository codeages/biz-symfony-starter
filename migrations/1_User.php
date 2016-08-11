<?php

use Phpmig\Migration\Migration;

/**
 *
 */
class User extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $container = $this->getContainer();
        $table = new Doctrine\DBAL\Schema\Table('user');
        $table->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement'=> true));
        $table->addColumn('username', 'string', array('length' => 64, 'null' => false, 'comment' => '用户名'));
        $table->addColumn('password', 'string', array('length' => 64, 'null' => false, 'comment' => '密码'));
        $table->addColumn('salt', 'string', array('length' => 64, 'null' => false, 'comment' => '密码加密Salt'));
        $table->addColumn('roles', 'string', array('length' => 512, 'null' => false, 'comment' => '角色'));
        $table->addColumn('updated', 'integer', array('default' => 0, 'signed' => true));
        $table->addColumn('created', 'integer', array('default' => 0, 'signed' => true));
        $table->setPrimaryKey(array('id'));
        $table->addUniqueIndex(array('username'));
        $container['db']->getSchemaManager()->createTable($table);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $container = $this->getContainer();
        $container['db']->getSchemaManager()->dropTable('user');
    }
}
