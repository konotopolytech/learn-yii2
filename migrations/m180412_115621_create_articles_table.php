<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articles`.
 */
class m180412_115621_create_articles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('articles', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'body' => $this->text()->notNull(),
            'date_create' => $this->timestamp(),
            'date_update' => $this->timestamp(),
            'public' => $this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('articles');
    }
}
