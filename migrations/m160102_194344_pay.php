<?php

use yii\db\Schema;
use yii\db\Migration;

class m160102_194344_pay extends Migration
{
    public function up()
    {
        $this->execute('CREATE TABLE `bog_shop_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_type` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `datetime` varchar(255) DEFAULT NULL,
  `date_insert` int(11) DEFAULT NULL,
  `codepro` varchar(255) DEFAULT NULL,
  `withdraw_amount` float DEFAULT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `sha1_hash` varchar(255) DEFAULT NULL,
  `unaccepted` varchar(255) DEFAULT NULL,
  `operation_label` varchar(255) DEFAULT NULL,
  `operation_id` varchar(255) DEFAULT NULL,
  `currency` int(11) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function down()
    {
        echo "m160102_194344_pay cannot be reverted.\n";

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
