<?php

use www\widgets\common\GoogleAdSenseWidget;
use www\widgets\common\PaginationWidget;

$presenter = new \www\presenters\SubmissionPresenter();
?>

<div class="ui basic segment">
    <?= /** @noinspection PhpUnhandledExceptionInspection */ GoogleAdSenseWidget::widget() ?>
</div>
<h2 class="ui header"><?= /** @var \common\models\Problem $problem */ $problem->title ?></h2>
<div class="ui top fluid four item menu">
    <a class="item" href="/problem?problem_id=<?= $problem->id ?>">Problem</a>
    <a class="item active">Submissions</a>
    <a class="item" href="/problem/discussions?problem_id=<?= $problem->id ?>">Discussions</a>
    <a class="item" href="/problem/editorial?problem_id=<?= $problem->id ?>">Editorial</a>
</div>
<table class="ui single line table">
    <thead>
    <tr>
        <th class="two wide">User</th>
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
<script>
    $(document).ready(function () {
        $('.menu .item').tab();
    });
</script>