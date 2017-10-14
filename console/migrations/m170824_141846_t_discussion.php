<?php

use yii\db\Migration;

class m170824_141846_t_discussion extends Migration {
    public function safeUp() {
        $this->createTable('t_discussion', [
            'id' => $this->primaryKey(),
            'problem_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'up_vote' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey(
            'fk_t_discussion_problem_id',
            't_discussion',
            'problem_id',
            't_problem',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_t_discussion_user_id',
            't_discussion',
            'user_id',
            't_user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx_problem_id',
            't_discussion',
            'problem_id'
        );
    }

    public function safeDown() {
        $this->dropForeignKey(
            'fk_t_discussion_problem_id',
            't_discussion'
        );

        $this->dropForeignKey(
            'fk_t_discussion_user_id',
            't_discussion'
        );

        $this->dropIndex(
            'idx_problem_id',
            't_discussion'
        );

        $this->dropTable('t_discussion');
    }
}
