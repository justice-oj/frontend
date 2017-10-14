<?php

use yii\db\Migration;

class m170810_085344_t_test_case extends Migration {
    public function safeUp() {
        $this->createTable('t_test_case', [
            'id' => $this->primaryKey(),
            'problem_id' => $this->integer()->notNull(),
            'input' => $this->text()->notNull(),
            'output' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()')
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey(
            'fk_t_test_case_problem_id',
            't_test_case',
            'problem_id',
            't_problem',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx_problem_id',
            't_test_case',
            'problem_id'
        );
    }

    public function safeDown() {
        $this->dropForeignKey(
            'fk_t_test_case_problem_id',
            't_test_case'
        );

        $this->dropIndex(
            'idx_problem_id',
            't_test_case'
        );

        $this->dropTable('t_test_case');
    }
}
