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
    <a class="item" href="/problem?problem_id=<?= $problem->id ?>">Problem</a>
    <a class="item" href="/problem/submissions?problem_id=<?= $problem->id ?>">Submissions</a>
    <a class="item" href="/problem/discussions?problem_id=<?= $problem->id ?>">Discussions</a>
    <a class="item active">Editorial</a>
</div>
<?php
if (is_null($editorial)) {
    echo <<< NULL
<div class="ui basic center aligned segment">
  <i class="massive icons">
    <i class="file text outline icon"></i>
    <i class="bottom right corner help icon"></i>
  </i>
  <h2 class="ui header">To be done.</h2>
</div>
NULL;
} else {
    echo <<< ARTICLE
<div class="ui basic segment">
    {$editorial->content}
</div>
ARTICLE;
}
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
<script>
    $(document).ready(function () {
        $('.menu .item').tab();
        $('.ui.embed').embed();
    });
</script>