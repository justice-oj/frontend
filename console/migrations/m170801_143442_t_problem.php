<?php

use yii\db\Migration;

class m170801_143442_t_problem extends Migration {
    public function safeUp() {
        $this->createTable('t_problem', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'level' => $this->integer()->notNull(),
            'runtime_limit' => $this->integer()->notNull(),
            'memory_limit' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');
    }

    public function safeDown() {
        $this->dropTable('t_problem');
    }
}
