<?php

use yii\db\Migration;

class m170810_085344_t_test_case extends Migration {
    public function up() {
        $this->createTable('t_test_case', [
            'id' => $this->primaryKey(),
            'problem_id' => $this->integer()->notNull(),
            'input' => $this->text()->notNull(),
            'output' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()')
        ]);

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

    public function down() {
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
