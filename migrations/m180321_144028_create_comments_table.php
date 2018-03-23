<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `comments`.
 */
class m180321_144028_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'post_id'=> $this->integer(9),
            'author_name' =>  $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'created_at'=> $this->timestamp()->notNull()
        ]);

        $this->createIndex(
            'idx-comment-post_id',
            'comment',
            'post_id'
        );

        $this->addForeignKey(
            'fk-comment-post_id',
            'comment',
            'post_id',
            'post',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `comments`
        $this->dropForeignKey(
            'fk-comment-post_id',
            'comment'
        );

        // drops index for column `post_id`
        $this->dropIndex(
            'idx-comment-post_id',
            'comment'
        );

        $this->dropTable('comments');
    }
}
