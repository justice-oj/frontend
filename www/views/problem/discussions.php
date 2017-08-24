<?php

use www\widgets\common\GoogleAdSenseWidget;

$user_presenter = new \www\presenters\UserPresenter();

?>
<style>
    .ui.comments {
        max-width: none;
    }
</style>
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
    <a class="item active">Discussions</a>
    <a class="item" href="/problem/editorial?problem_id=<?= $problem->id ?>">Editorial</a>
</div>
<div class="ui large comments">
    <?php
    foreach ($discussions as $discussion) {
        echo <<< DISCUSSION
    <div class="comment">
        <a class="avatar">
            <img src="{$user_presenter->showAvatar($discussion->user->email)}">
        </a>
        <div class="content">
            <a class="author">{$discussion->user->username}</a>
            <div class="metadata">
                <div class="date">2 days ago</div>
                <div class="rating">
                    <i class="star icon"></i>
                    {$discussion->up_vote} Likes
                </div>
            </div>
            <div class="text content">{$discussion->content}</div>
            <div class="actions">
                <a class="reply">Reply</a>
            </div>
        </div>
    </div>
DISCUSSION;
    }
    ?>
    <form class="ui reply form">
        <div class="field">
            <div class="content" style="height: 400px"></div>
        </div>
        <div class="ui blue labeled submit icon button">
            <i class="icon edit"></i> Add Reply
        </div>
    </form>
</div>
<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget() ?>
</div>
<script>
    $(document).ready(function () {
        $('.menu .item').tab();

        var quill = new Quill('.content', {
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{'header': 1}, {'header': 2}],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'script': 'sub'}, {'script': 'super'}],
                    [{'indent': '-1'}, {'indent': '+1'}],
                    ['link', 'image'],
                    ['formula'],
                    ['clean']
                ]
            },
            theme: 'snow'
        });
    });
</script>