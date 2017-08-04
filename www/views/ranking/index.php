<?php

use www\widgets\common\PaginationWidget;

$problem_presenter = new www\presenters\ProblemPresenter();
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
    foreach ((array) $records as $record) {
        echo <<< USER
    <tr>
        <td>
            <i class="{$record['country']} flag"></i>
            <a href="/profile/{$record['username']}" target="_blank">{$record['username']}</a>
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