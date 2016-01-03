<?php

use yii\db\Schema;
use yii\db\Migration;

class m151105_184316_video extends Migration
{
    public function up()
    {
//        $this->execute('ALTER TABLE galaxysss_5.rod_article_list ADD video VARCHAR(255) NULL;');
    }

    public function down()
    {
        echo "m151105_184316_video cannot be reverted.\n";

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
