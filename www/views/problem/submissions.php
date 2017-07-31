<?php

use www\widgets\common\PaginationWidget;

$presenter = new \www\presenters\SubmissionPresenter();
?>

<div class="ui large centered leaderboard test ad" data-text="Large Leaderboard"></div>
<h2 class="ui header"><?= $problem->title ?></h2>
<div class="ui top fluid four item menu">
    <a class="item" href="/problem?id=<?= $problem->id ?>">Problem</a>
    <a class="item active">Submissions</a>
    <a class="item" href="/problem/discussions?problem_id=<?= $problem->id ?>">Discussions</a>
    <a class="item" href="/problem/editorial?problem_id=<?= $problem->id ?>">Editorial</a>
</div>
<table class="ui selectable celled table">
    <thead>
    <tr>
        <th class="one wide">#</th>
        <th class="two wide">Username</th>
        <th class="two wide">Language</th>
        <th class="two wide">Status</th>
        <th class="two wide">Time (ms)</th>
        <th class="two wide">Memory (MB)</th>
        <th class="three wide">Submit Time</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ((array) $records as $record) {
        echo <<< SUBMISSION
    <tr>
        <td>{$record->id}</td>
        <td>{$record->user->username}</td>
        <td>{$presenter->showLanguage($record->language)}</td>
        <td><a href="/submission?id={$record->id}" target="_blank">{$presenter->showStatus($record->status)}</a></td>
        <td>{$record->runtime}</td>
        <td>{$record->memory}</td>
        <td>{$record->created_at}</td>
    </tr>
SUBMISSION;
    }
    ?>
    </tbody>
</table>
<?= PaginationWidget::widget(['pagination' => $pagination]); ?>
<div class="ui large centered leaderboard test ad" data-text="AD"></div>
<script>
    $(document).ready(function () {
        $('.menu .item').tab();
    });
</script>