<?php

use yii\db\Migration;

class m170811_032743_t_admin extends Migration {
    public function safeUp() {
        $this->createTable('t_admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');

        $this->createIndex(
            'idx_username_unique',
            't_admin',
            'username',
            true
        );
    }

    public function safeDown() {
        $this->dropIndex(
            'idx_username_unique',
            't_admin'
        );

        $this->dropTable('t_admin');
    }
}
