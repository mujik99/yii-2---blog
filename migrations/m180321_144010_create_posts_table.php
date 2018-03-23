<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m180321_144010_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'user_name' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'created_at'=> $this->timestamp()->notNull()
        ]);



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('post');
    }
}
