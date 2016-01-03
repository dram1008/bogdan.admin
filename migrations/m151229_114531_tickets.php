<?php

use yii\db\Schema;
use yii\db\Migration;

class m151229_114531_tickets extends Migration
{
    public function up()
    {
        $this->execute('ALTER TABLE bog_shop_product ADD tickets_counter TINYINT(1) NULL;');
    }

    public function down()
    {
        echo "m151229_114531_tickets cannot be reverted.\n";

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
