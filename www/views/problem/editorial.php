<?php

use www\widgets\common\GoogleAdSenseWidget;

?>

<link href="https://cdn.quilljs.com/1.3.1/quill.snow.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.1/quill.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget() ?>
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
<div class="ui basic segment" id="article"></div>
<script>
var quill = new Quill('#article', {
    modules: {
        toolbar: null
    },
    readOnly: true,
    theme: 'snow'
});
quill.setContents({$editorial->content});
</script>
ARTICLE;
}
?>

<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget() ?>
</div>
<script>
    $(document).ready(function () {
        $('.menu .item').tab();
        $('.ui.embed').embed();
    });
</script>