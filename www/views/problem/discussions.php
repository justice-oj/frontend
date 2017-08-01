<?php
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
    <a class="item" href="/problem/submissions?problem_id=<?= $problem->id ?>">Submissions</a>
    <a class="item active">Discussions</a>
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
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
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