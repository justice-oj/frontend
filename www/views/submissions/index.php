<?php

use www\widgets\common\GoogleAdSenseWidget;
use www\widgets\common\PaginationWidget;

$presenter = new \www\presenters\SubmissionPresenter();
?>

<div class="ui basic segment">
    <?= /** @noinspection PhpUnhandledExceptionInspection */ GoogleAdSenseWidget::widget() ?>
</div>
<h2 class="ui header">Submissions</h2>
<table class="ui single line table">
    <thead>
    <tr>
        <th class="two wide">User</th>
        <th class="four wide">Problem</th>
        <th class="one wide">Language</th>
        <th class="two wide">Status</th>
        <th class="one wide">Time</th>
        <th class="one wide">Memory</th>
        <th class="two wide">Submit Time</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /** @var array $records */
    foreach ((array) $records as $record) {
        echo <<< SUBMISSION
    <tr>
        <td>
        <i class="{$record['country']} flag"></i>
        <a href="/profile?name={$record['username']}">{$record['username']}</a>
        </td>
        <td>
        <a href="/problem/?problem_id={$record['problem_id']}">{$record['problem_title']}</a>
        </td>
        <td>{$presenter->showLanguage($record['language'])}</td>
        <td><a href="/submission?id={$record['id']}">{$presenter->showStatus($record['status'])}</a></td>
        <td>{$presenter->showRuntime($record['runtime'])}</td>
        <td>{$presenter->showMemory($record['memory'])}</td>
        <td>{$record['created_at']}</td>
    </tr>
SUBMISSION;
    }
    ?>
    </tbody>
</table>
<?= /** @noinspection PhpUnhandledExceptionInspection */
/** @var array $pagination */
PaginationWidget::widget(['pagination' => $pagination]) ?>
<div class="ui basic segment">
    <?= /** @noinspection PhpUnhandledExceptionInspection */ GoogleAdSenseWidget::widget() ?>
</div>