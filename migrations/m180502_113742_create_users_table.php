<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m180502_113742_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'pwd' => $this->string()->notNull(),
            'admin' => $this->boolean()
        ]);
        
        $this->insert('users', [
            'username' => 'admin',
            'email' => 'admin@example.com',
            'pwd' => \Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'admin' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
