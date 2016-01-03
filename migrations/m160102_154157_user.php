<?php

use yii\db\Schema;
use yii\db\Migration;

class m160102_154157_user extends Migration
{
    public function up()
    {
        $this->execute('ALTER TABLE gs_users ADD subscribe_is_bogdan TINYINT(1) NULL;');
    }

    public function down()
    {
        echo "m160102_154157_user cannot be reverted.\n";

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
