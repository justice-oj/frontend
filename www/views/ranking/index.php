<?php

use www\widgets\common\GoogleAdSenseWidget;
use www\widgets\common\PaginationWidget;

$problem_presenter = new www\presenters\ProblemPresenter();
?>

<div class="ui basic segment">
    <?= /** @noinspection PhpUnhandledExceptionInspection */ GoogleAdSenseWidget::widget() ?>
</div>
<h2 class="ui header">Ranking</h2>
<table class="ui selectable celled table">
    <thead>
    <tr>
        <th class="five wide">User</th>
        <th class="two wide">Solved</th>
        <th class="two wide">Tried</th>
        <th class="two wide">Submissions</th>
        <th class="two wide">AC</th>
        <th class="three wide">Since</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /** @var array $records */
    foreach ((array) $records as $record) {
        echo <<< USER
    <tr>
        <td>
            <i class="{$record['country']} flag"></i>
            <a href="/profile?name={$record['username']}">{$record['username']}</a>
        </td>
        <td>{$record['solved']}</td>
        <td>{$record['tried']}</td>
        <td>{$record['submissions']}</td>
        <td>{$record['AC']} %</td>
        <td>{$record['since']}</td>
    </tr>
USER;
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