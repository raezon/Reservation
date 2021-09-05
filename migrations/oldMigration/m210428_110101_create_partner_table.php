<?php

use yii\db\Schema;

class m210428_110101_create_partner_table extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%partner}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'address' => $this->string(255)->notNull(),
            'tel' => $this->string(10),
            'mobile' => $this->string(12)->notNull(),
            'fax' => $this->string(13)->notNull(),
            'web_site' => $this->string(255),
            'country' => $this->string(255)->notNull(),
            'city' => $this->string(255)->notNull(),
            'postal_code' => $this->string(255),
            'keywords' => $this->string(255),
            'email' => $this->string(255),
            'picture' => $this->string(255),
            'user_id' => $this->integer(255)->notNull(),
            'category_id' => $this->integer(11)->notNull(),
            'status' => $this->integer(11)->notNull(),
            'latitude' => $this->double()->notNull(),
            'longitude' => $this->double()->notNull(),
            'DeliveryAndDeplacement' => $this->string(5000)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'FOREIGN KEY ([[category_id]]) REFERENCES {{%partner_category}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[user_id]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%partner}}');
    }
}
