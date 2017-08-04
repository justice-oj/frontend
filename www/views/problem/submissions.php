<?php
use www\widgets\common\PaginationWidget;
$presenter = new \www\presenters\SubmissionPresenter();
?>

<div class="ui basic segment">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- justice.plus -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-3748357229978150"
         data-ad-slot="6514368667"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
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
        <th class="two wide">User</th>
        <th class="one wide">Language</th>
        <th class="three wide">Status</th>
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
        <td>
        <i class="{$record->user->country} flag"></i>
        <a href="/profile/{$record->user->username}" target="_blank">{$record->user->username}</a>
        </td>
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
<div class="ui basic segment">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- justice.plus -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-3748357229978150"
         data-ad-slot="6514368667"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
<script>
    $(document).ready(function () {
        $('.menu .item').tab();
    });
</script>