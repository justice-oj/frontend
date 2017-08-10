<?php

use yii\db\Migration;

class m170802_140548_t_user extends Migration {
    public function up() {
        $this->createTable('t_user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'nickname' => $this->string()->notNull(),
            'bio' => $this->text()->notNull(),
            'email' => $this->string()->notNull(),
            'website' => $this->string()->notNull(),
            'country' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);

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

    public function down() {
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
