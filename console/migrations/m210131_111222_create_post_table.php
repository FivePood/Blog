<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m210131_111222_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'postId' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'title' => $this->string(),
            'content' => $this->text(),
            'date' => $this->date(),
        ]);

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-post-user-id-1',
            'post',
            'userId',
            'user',
            'userId',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
