<?php

use www\widgets\common\GoogleAdSenseWidget;

?>

<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget(); ?>
</div>
<h2 class="ui header"><?= $problem->title ?></h2>
<div class="ui top fluid four item menu">
    <a class="item" href="/problem?problem_id=<?= $problem->id ?>">Problem</a>
    <a class="item" href="/problem/submissions?problem_id=<?= $problem->id ?>">Submissions</a>
    <a class="item active">Discussions</a>
    <a class="item" href="/problem/editorial?problem_id=<?= $problem->id ?>">Editorial</a>
</div>
<table class="ui very basic table">
    <thead>
    <tr>
        <th>Topic</th>
        <th>Replies</th>
        <th>Views</th>
        <th>Activity</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>John</td>
        <td>John</td>
        <td>Approved</td>
        <td>None</td>
    </tr>
    <tr>
        <td>Jamie</td>
        <td>Approved</td>
        <td>Approved</td>
        <td>Requires call</td>
    </tr>
    <tr>
        <td>Jill</td>
        <td>Denied</td>
        <td>Denied</td>
        <td>None</td>
    </tr>
    </tbody>
</table>
<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget(); ?>
</div>
<script>
    $(document).ready(function () {
        $('.menu .item').tab();
    });
</script>