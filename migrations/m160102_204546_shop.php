<?php

use yii\db\Schema;
use yii\db\Migration;

class m160102_204546_shop extends Migration
{
    public function up()
    {
        $this->execute('ALTER TABLE bog_shop_payments ADD is_valid TINYINT(1) NULL;');
    }

    public function down()
    {
        echo "m160102_204546_shop cannot be reverted.\n";

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
