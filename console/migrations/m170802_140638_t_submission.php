<?php

use common\models\Submission;
use yii\db\Migration;

class m170802_140638_t_submission extends Migration {
    public function up() {
        $this->createTable('t_submission', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'problem_id' => $this->integer()->notNull(),
            'language' => $this->integer()->notNull(),
            'code' => $this->text()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(Submission::STATUS_QUEUE),
            'runtime' => $this->integer()->notNull()->defaultValue(-1),
            'memory' => $this->integer()->notNull()->defaultValue(-1),
            'error' => $this->text(),
            'input' => $this->text(),
            'output' => $this->text(),
            'expected' => $this->text(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()')
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey(
            'fk_t_submission_problem_id',
            't_submission',
            'problem_id',
            't_problem',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_t_submission_user_id',
            't_submission',
            'user_id',
            't_user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx_problem_id',
            't_submission',
            'problem_id'
        );

        $this->createIndex(
            'idx_user_id',
            't_submission',
            'user_id'
        );
    }

    public function down() {
        $this->dropForeignKey(
            'fk_t_submission_problem_id',
            't_submission'
        );

        $this->dropForeignKey(
            'fk_t_submission_user_id',
            't_submission'
        );

        $this->dropIndex(
            'idx_user_id',
            't_submission'
        );

        $this->dropIndex(
            'idx_problem_id',
            't_submission'
        );

        $this->dropTable('t_submission');
    }
}
