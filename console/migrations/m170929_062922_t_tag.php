<?php

use yii\db\Migration;

class m170929_062922_t_tag extends Migration {
    public function safeUp() {
        $this->createTable('t_tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');

        $this->createIndex(
            'idx_tag_name',
            't_tag',
            'name',
            true
        );
    }


    public function down() {
        $this->dropIndex(
            'idx_tag_name',
            't_tag'
        );

        $this->dropTable('t_tag');
    }
}
