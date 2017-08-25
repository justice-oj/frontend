<?php

use Carbon\Carbon;
use www\widgets\common\GoogleAdSenseWidget;

$user_presenter = new \www\presenters\UserPresenter();

?>
<style>
    .ui.comments {
        max-width: none;
    }
</style>
<link href="<?= Yii::$app->params['staticFile']['KaTex']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['KaTex']['js'] ?>"></script>
<link href="<?= Yii::$app->params['staticFile']['Quill']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['Quill']['js'] ?>"></script>
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
        $t = Carbon::instance(new DateTime($discussion->created_at))->diffForHumans();
        echo <<< DISCUSSION
    <div class="comment">
        <a class="avatar">
            <img src="{$user_presenter->showAvatar($discussion->user->email)}">
        </a>
        <div class="content">
            <a class="author" href="/profile?name={$discussion->user->username}">{$discussion->user->username}</a>
            <div class="metadata">
                <div class="rating">
                    {$discussion->up_vote}
                    <i class="star icon"></i>
                </div>
                <div class="date">{$t}</div>
            </div>
            <div class="text" id="quill_{$discussion->id}"></div>
            <div class="actions">
                <a class="reply">Reply</a>
            </div>
        </div>
    </div>
    <script>
    var quill_{$discussion->id} = new Quill('#quill_{$discussion->id}', {
        modules: {toolbar: null},
        readOnly: true,
        theme: 'snow'
    });
    quill_{$discussion->id}.setContents({$discussion->content});
    </script>
DISCUSSION;
    }
    ?>
    <form class="ui reply form">
        <div class="field">
            <div id="reply" style="height: 400px"></div>
        </div>
        <div class="ui blue labeled submit icon button" id="add_reply">
            <i class="icon edit"></i> Add Reply
        </div>
    </form>
</div>
<div class="ui tiny modal" id="null">
    <div class="header">Please leave your message here</div>
</div>
<div class="ui modal" id="tip">
    <div class="header" id="tip_header"></div>
    <div class="content">
        <p id="tip_desc"></p>
    </div>
    <div class="actions">
        <div class="ui primary button ok">OK</div>
    </div>
</div>
<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget() ?>
</div>
<script>
    $(document).ready(function () {
        $('.menu .item').tab();

        var quill = new Quill('#reply', {
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

        $('#add_reply').on('click', function () {
            if (quill.getText().trim().length === 0) {
                $('#null').modal('show').delay(1500).queue(function() {
                    $(this).modal('hide').dequeue();
                });
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/problem/add-discussion',
                data: {
                    problem_id: '<?= $problem->id ?>',
                    content: JSON.stringify(quill.getContents())
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.reload();
                    } else {
                        $('#tip_header').text("Error");
                        $('#tip_desc').text(res.message);
                        $('#tip').modal('show');
                    }
                },
                error: function () {
                    $('#tip_header').text("Error");
                    $('#tip_desc').text("An error occurred, please try later.");
                    $('#tip').modal('show');
                }
            });
        })
    });
</script>