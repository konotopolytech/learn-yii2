<?php

use yii\db\Migration;

/**
 * Class m180418_140304_add_foreign_key_to
 */
class m180418_140304_add_foreign_key_to extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('articles', 'comment_id', $this->integer());
      
        // add foreign key for table `articles`
        $this->addForeignKey(
            'fk-articles-comment_id',
            'articles',
            'comment_id',
            'comments',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-articles-comment_id', 'articles');      
        $this->dropColumn('articles', 'comment_id');      
    } 
}
