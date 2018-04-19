<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m180418_132133_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),            
            'comment' => $this->text()->notNull(),
            'date_create' => $this->timestamp(),
            'enabled' => $this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comments');
    }
}
