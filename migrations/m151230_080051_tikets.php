<?php

use yii\db\Schema;
use yii\db\Migration;

class m151230_080051_tikets extends Migration
{
    public function up()
    {
        $this->execute('CREATE TABLE `bog_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `counter` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->insert('bog_counter', ['id' => 1, 'counter' => 0]);
    }

    public function down()
    {
        echo "m151230_080051_tikets cannot be reverted.\n";

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
