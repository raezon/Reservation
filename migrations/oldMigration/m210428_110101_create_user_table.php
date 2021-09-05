<?php

use yii\db\Schema;

class m210428_110101_create_user_table extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'password_hash' => $this->string(60)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'confirmed_at' => $this->integer(11),
            'unconfirmed_email' => $this->string(255),
            'blocked_at' => $this->integer(11),
            'registration_ip' => $this->string(45),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'flags' => $this->integer(11)->notNull()->defaultValue(0),
            'last_login_at' => $this->integer(11),
            'api_key' => $this->string(255),
            'status' => $this->integer(11)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
