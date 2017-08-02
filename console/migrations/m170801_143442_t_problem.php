<?php

use yii\db\Migration;

class m170801_143442_t_problem extends Migration {
    public function up() {
        $this->createTable('t_problem', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'input' => $this->text()->notNull(),
            'output' => $this->text()->notNull(),
            'sample_input' => $this->text()->notNull(),
            'sample_output' => $this->text()->notNull(),
            'level' => $this->integer()->notNull(),
            'runtime_limit' => $this->integer()->notNull(),
            'memory_limit' => $this->integer()->notNull(),
            'submission_count' => $this->integer()->notNull(),
            'accepted_count' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull()
        ]);
    }

    public function down() {
        $this->dropTable('t_problem');
    }
}
