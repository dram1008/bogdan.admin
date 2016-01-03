<?php

use yii\db\Schema;
use yii\db\Migration;

class m160102_221023_angels extends Migration
{
    public function up()
    {
        $this->execute('ALTER TABLE bog_pictures ADD name VARCHAR(255) NULL;');
        $this->execute('ALTER TABLE bog_pictures ADD description VARCHAR(2000) NULL;');
        $this->execute('ALTER TABLE bog_pictures ADD content text NULL;');
    }

    public function down()
    {
        echo "m160102_221023_angels cannot be reverted.\n";

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
