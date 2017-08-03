<?php

use yii\db\Migration;

class m170803_145915_t_editorial extends Migration {
    public function up() {
        $this->createTable('t_editorial', [
            'id' => $this->primaryKey(),
            'problem_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull()->defaultValue(1),
            'content' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull()
        ]);

        $this->addForeignKey(
            'fk_t_editorial_problem_id',
            't_editorial',
            'problem_id',
            't_problem',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_t_editorial_author_id',
            't_editorial',
            'author_id',
            't_user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx_problem_id',
            't_editorial',
            'problem_id',
            true
        );

        $this->createIndex(
            'idx_author_id',
            't_editorial',
            'author_id'
        );
    }

    public function down() {
        $this->dropForeignKey(
            'fk_t_editorial_problem_id',
            't_editorial'
        );

        $this->dropForeignKey(
            'fk_t_editorial_author_id',
            't_editorial'
        );

        $this->dropIndex(
            'idx_problem_id',
            't_editorial'
        );

        $this->dropIndex(
            'idx_author_id',
            't_editorial'
        );

        $this->dropTable('t_editorial');
    }
}
