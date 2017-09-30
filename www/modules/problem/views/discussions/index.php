<?php

use Carbon\Carbon;
use www\widgets\common\GoogleAdSenseWidget;
use www\widgets\common\PaginationWidget;

$user_presenter = new \www\presenters\UserPresenter();

?>
<style>
    .ui.comments {
        max-width: none;
    }
    .anchor {
        position: relative;
        top: -3em;
        display: block;
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
    foreach ($discussions as $k => $discussion) {
        // human readable time format
        $t = Carbon::createFromFormat('Y-m-d H:i:s', $discussion['created_at'], date_default_timezone_get())->diffForHumans();
        // up-voted style
        $empty = Yii::$app->get('redis')->getbit($key, $discussion['id']) ? '' : 'empty';

        echo <<< DISCUSSION
    <a name="L{$discussion['id']}" class="anchor"></a>
    <div class="comment">
        <a class="avatar">
            <img src="{$user_presenter->showAvatar($discussion['email'])}">
        </a>
        <div class="content">
            <a class="author" href="/profile?name={$discussion['username']}">{$discussion['username']}</a>
            <div class="metadata">
                <div class="rating" data-id="{$discussion['id']}">
                    {$discussion['up_vote']}<i class="{$empty} star icon"></i>
                </div>
                <div class="date">{$t}</div>
            </div>
            <div class="text" id="quill_{$discussion['id']}"></div>
            <div class="actions">
                <a class="reply quick_reply" data-user="{$discussion['username']}">Reply</a>
            </div>
        </div>
    </div>
    <script>
    var quill_{$discussion['id']} = new Quill('#quill_{$discussion['id']}', {
        modules: {toolbar: null},
        readOnly: true,
        theme: 'snow'
    });
    quill_{$discussion['id']}.setContents({$discussion['content']});
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
<?= PaginationWidget::widget(['pagination' => $pagination]) ?>
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

        // quick reply
        $('.quick_reply').on('click', function () {
            quill.focus();

            var text = '@' + $(this).data('user') + ' ',
                cursor = quill.getSelection().index;
            quill.insertText(cursor, text, {color: '#2185d0', bold: true});
            quill.setSelection(cursor + text.length);
            quill.removeFormat(cursor + text.length - 1, 1);
        });

        //add reply
        $('#add_reply').on('click', function () {
            if (quill.getText().trim().length === 0) {
                $('#null').modal('show').delay(1500).queue(function() {
                    $(this).modal('hide').dequeue();
                });
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/problem/discussions/add',
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
        });

        // up-vote
        $('.rating').on('click', function () {
            var star = $(this);
            $.ajax({
                type: 'POST',
                url: '/problem/discussions/up-vote',
                data: {
                    discussion_id: star.data('id')
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        if (res.data.current) {
                            $(star).html(res.data.count + '<i class="star icon"></i>');
                        } else {
                            $(star).html(res.data.count + '<i class="empty star icon"></i>');
                        }
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
        });
    });
</script>