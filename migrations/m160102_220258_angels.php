<?php

use yii\db\Schema;
use yii\db\Migration;

class m160102_220258_angels extends Migration
{
    public function up()
    {
        $this->execute('CREATE TABLE `bog_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `tree_node_id_mask` bigint  DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function down()
    {
        echo "m160102_220258_angels cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
