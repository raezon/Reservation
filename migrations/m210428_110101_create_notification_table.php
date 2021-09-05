<?php

use yii\db\Schema;

class m210428_110101_create_notification_table extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%notificationsuser}}', [
            'id' => $this->primaryKey(),
            'class' => $this->string(64)->notNull(),
            'key' => $this->string(32)->notNull(),
            'key2' => $this->string(5000)->notNull(),
            'message' => $this->string(255)->notNull(),
            'answer' => $this->string(255)->notNull(),
            'route' => $this->string(255)->notNull(),
            'seen' => $this->integer(11)->notNull()->defaultValue(0),
            'read' => $this->integer(11)->notNull()->defaultValue(0),
            'user_id' => $this->integer(11)->notNull()->defaultValue(0),
            'sender_id' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(11)->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%notificationsuser}}');
    }
}
