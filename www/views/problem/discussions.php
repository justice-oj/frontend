<?php

use www\widgets\common\GoogleAdSenseWidget;

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
    <div class="comment">
        <a class="avatar">
            <img src="https://semantic-ui.com/images/avatar/small/stevie.jpg">
        </a>
        <div class="content">
            <a class="author">Stevie Feliciano</a>
            <div class="metadata">
                <div class="date">2 days ago</div>
                <div class="rating">
                    <i class="star icon"></i>
                    5 Likes
                </div>
            </div>
            <div class="text">
                Hey guys, I hope this example comment is helping you read this documentation. Dude, this is awesome. Thanks so much. I'm very interested in this motherboard. Do you know if it'd work in a Intel LGA775 CPU socket?
            </div>
            <div class="actions">
                <a class="reply">Reply</a>
            </div>
        </div>
    </div>
    <div class="comment">
        <a class="avatar">
            <img src="https://semantic-ui.com/images/avatar/small/elliot.jpg">
        </a>
        <div class="content">
            <a class="author">Stevie Feliciano</a>
            <div class="metadata">
                <div class="date">2 days ago</div>
                <div class="rating">
                    <i class="star icon"></i>
                    5 Likes
                </div>
            </div>
            <div class="text">
                Hey guys, I hope this example comment is helping you read this documentation. Dude, this is awesome. Thanks so much. I'm very interested in this motherboard. Do you know if it'd work in a Intel LGA775 CPU socket?
            </div>
            <div class="actions">
                <a class="reply">Reply</a>
            </div>
        </div>
    </div>
    <div class="comment">
        <a class="avatar">
            <img src="https://semantic-ui.com/images/avatar/small/joe.jpg">
        </a>
        <div class="content">
            <a class="author">Stevie Feliciano</a>
            <div class="metadata">
                <div class="date">2 days ago</div>
                <div class="rating">
                    <i class="star icon"></i>
                    5 Likes
                </div>
            </div>
            <div class="text">
                Hey guys, I hope this example comment is helping you read this documentation. Dude, this is awesome. Thanks so much. I'm very interested in this motherboard. Do you know if it'd work in a Intel LGA775 CPU socket?
            </div>
            <div class="actions">
                <a class="reply">Reply</a>
            </div>
        </div>
    </div>
    <form class="ui reply form">
        <div class="field">
            <input name="reply" type="hidden">
            <div id="reply" style="height: 400px"></div>
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
            placeholder: 'Add your reply here',
            theme: 'snow'
        });
    });
</script>