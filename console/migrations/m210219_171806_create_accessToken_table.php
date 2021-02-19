<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%accessToken}}`.
 */
class m210219_171806_create_accessToken_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%accessToken}}', [
            'accessTokenId' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'accessToken' => $this->string()->notNull()->unique(),
        ]);

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-token-user-id',
            'accessToken',
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
        $this->dropTable('{{%accessToken}}');
    }
}
