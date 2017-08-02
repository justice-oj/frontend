<?php

use yii\db\Migration;

class m170802_144031_t_user_problem extends Migration {
    public function up() {
        $this->createTable('t_user_problem', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'problem_id' => $this->integer()->notNull(),
            'status' => $this->integer(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull()
        ]);

        $this->addForeignKey(
            'fk_t_user_problem_problem_id',
            't_user_problem',
            'problem_id',
            't_problem',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_t_user_problem_user_id',
            't_user_problem',
            'user_id',
            't_user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx_user_id_problem_id_unique',
            't_user_problem',
            ['user_id', 'problem_id'],
            true
        );
    }

    public function down() {
        $this->dropForeignKey(
            'fk_t_user_problem_problem_id',
            't_user_problem'
        );

        $this->dropForeignKey(
            'fk_t_user_problem_user_id',
            't_user_problem'
        );

        $this->dropIndex(
            'idx_user_id_problem_id_unique',
            't_user_problem'
        );

        $this->dropTable('t_user_problem');
    }
}
