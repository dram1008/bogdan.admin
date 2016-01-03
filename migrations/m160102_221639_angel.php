<?php

use yii\db\Schema;
use yii\db\Migration;

class m160102_221639_angel extends Migration
{
    public function up()
    {
        $this->execute('CREATE TABLE `bog_pictures_tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sort_index` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->insert('bog_pictures_tree', ['name' => 'root']);
    }

    public function down()
    {
        echo "m160102_221639_angel cannot be reverted.\n";

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
