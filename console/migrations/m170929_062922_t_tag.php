<?php

use yii\db\Migration;

class m170929_062922_t_tag extends Migration {
    public function safeUp() {
        $this->createTable('t_tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);

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
