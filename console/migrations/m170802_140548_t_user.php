<?php

use yii\db\Migration;

class m170802_140548_t_user extends Migration {
    public function safeUp() {
        $this->createTable('t_user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'nickname' => $this->string(),
            'bio' => $this->text(),
            'email' => $this->string()->notNull(),
            'website' => $this->string(),
            'country' => $this->string(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');

        $this->createIndex(
            'idx_username_unique',
            't_user',
            'username',
            true
        );

        $this->createIndex(
            'idx_email_unique',
            't_user',
            'email',
            true
        );
    }

    public function safeDown() {
        $this->dropIndex(
            'idx_username_unique',
            't_user'
        );

        $this->dropIndex(
            'idx_email_unique',
            't_user'
        );

        $this->dropTable('t_user');
    }
}
