<?php

use yii\db\Migration;

class m170929_070008_t_problem_tag extends Migration {
    public function safeUp() {
        $this->createTable('t_problem_tag', [
            'id' => $this->primaryKey(),
            'problem_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()')
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey(
            'fk_t_problem_tag_problem_id',
            't_problem_tag',
            'problem_id',
            't_problem',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_t_problem_tag_tag_id',
            't_problem_tag',
            'tag_id',
            't_tag',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx_problem_id',
            't_problem_tag',
            ['problem_id', 'tag_id'],
            true
        );

        $this->createIndex(
            'idx_tag_id',
            't_problem_tag',
            'tag_id'
        );
    }

    public function down() {
        $this->dropForeignKey(
            'fk_t_problem_tag_problem_id',
            't_problem_tag'
        );

        $this->dropForeignKey(
            'fk_t_problem_tag_tag_id',
            't_problem_tag'
        );

        $this->dropIndex(
            'idx_problem_id',
            't_problem_tag'
        );

        $this->dropIndex(
            'idx_tag_id',
            't_problem_tag'
        );

        $this->dropTable('t_problem_tag');
    }
}
