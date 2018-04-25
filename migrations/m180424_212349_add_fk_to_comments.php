<?php

use yii\db\Migration;

/**
 * Class m180424_212349_add_fk_to_comments
 */
class m180424_212349_add_fk_to_comments extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        // add foreign key for table `articles`
        $this->addForeignKey(
            'fk-comments-article_id',
            'comments',
            'article_id',
            'article',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-comments-article_id', 'comments');      
    }
}
