<?php

use yii\db\Migration;

/**
 * Add status INT field to user table (needed by yii2-admin)
 */
class m191126_203932_add_status_field_to_user extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%user}}', 'status', \yii\db\Schema::TYPE_INTEGER);
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'status');
    }
}
