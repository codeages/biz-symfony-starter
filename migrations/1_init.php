<?php
use Phpmig\Migration\Migration;

class Init extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $container = $this->getContainer();

        $sql = "
         CREATE TABLE `user` (
          `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
          `username` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名',
          `password` varchar(64) NOT NULL DEFAULT '' COMMENT '用户密码',
          `salt` varchar(32) NOT NULL DEFAULT '' COMMENT '密码SALT',
          `roles` varchar(1024) NOT NULL DEFAULT '' COMMENT '角色',
          `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
          `updated_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
          PRIMARY KEY (`id`),
          UNIQUE KEY `username` (`username`)
        ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
        ";

        $container['db']->exec($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $container = $this->getContainer();
        $container['db']->exec("DROP TABLE `user`");
    }
}
