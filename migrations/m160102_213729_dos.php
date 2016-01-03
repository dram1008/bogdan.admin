<?php

use yii\db\Schema;
use yii\db\Migration;

class m160102_213729_dos extends Migration
{
    public function up()
    {
        $this->execute('ALTER TABLE bog_shop_requests ADD dostavka TINYINT NULL;');
    }

    public function down()
    {
        echo "m160102_213729_dos cannot be reverted.\n";

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
