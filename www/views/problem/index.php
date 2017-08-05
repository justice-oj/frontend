<?php

use www\widgets\common\GoogleAdSenseWidget;

?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.28.0/codemirror.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.28.0/theme/monokai.min.css" rel="stylesheet">
<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-MML-AM_CHTML"></script>
<script type="text/x-mathjax-config">
MathJax.Hub.Config({
  displayAlign: "left"
});
</script>
<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget() ?>
</div>
<h2 class="ui header"><?= $problem->title ?></h2>
<div class="ui top fluid four item menu">
    <a class="item active">Problem</a>
    <a class="item" href="/problem/submissions?problem_id=<?= $problem->id ?>">Submissions</a>
    <a class="item" href="/problem/discussions?problem_id=<?= $problem->id ?>">Discussions</a>
    <a class="item" href="/problem/editorial?problem_id=<?= $problem->id ?>">Editorial</a>
</div>
<div class="ui info small message">
    <ul class="list">
        <li>Memory Limit: <?= $problem->memory_limit ?> MB</li>
        <li>Time Limit: <?= $problem->runtime_limit ?> ms</li>
    </ul>
</div>
<div class="content">
    <?= $problem->description ?>
</div>
<h4 class="ui horizontal divider header">
    <i class="write icon"></i>
</h4>
<div class="fields">
    <div class="four wide field">
        <select class="ui dropdown" id="language">
            <option value="">Select Language</option>
            <option value="0">Java</option>
            <option value="1">C</option>
            <option value="2">C++</option>
            <option value="3">Python</option>
        </select>
    </div>
</div>
<div class="ui hidden negative message" id="msg">
    <div class="header">
        static main method must be contained in public class Main
    </div>
</div>
<h4 class="ui header">Paste your source code:</h4>
<textarea id="editor" rows="50"></textarea>
<div class="ui basic segment">
    <button class="ui primary basic button" id="submit">Submit</button>
</div>
<div class="ui tiny modal" id="null">
    <div class="header">Please select a language.</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.28.0/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.28.0/addon/edit/matchbrackets.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.28.0/mode/clike/clike.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.28.0/mode/python/python.min.js"></script>
<script>
    $(document).ready(function () {
        $('.menu .item').tab();

        var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
            lineNumbers: true,
            matchBrackets: true,
            indentUnit: 4,
            theme: 'monokai'
        });

        var language = $('#language'), msg = $('#msg');
        language.dropdown({
            onChange: function(val) {
                switch (val) {
                    case "0":
                        editor.setValue("public class Main {\n    public static void main(String[] args) {\n        /* Enter your code here. Read input from STDIN. Print output to STDOUT. Your class should be named Main. */\n    }\n}");
                        editor.setOption('mode', 'text/x-java');
                        msg.removeClass('hidden').addClass('visible');
                        break;
                    case "1":
                        editor.setValue("");
                        editor.setOption('mode', 'text/x-csrc');
                        msg.removeClass('visible').addClass('hidden');
                        break;
                    case "2":
                        editor.setValue("");
                        editor.setOption('mode', 'text/x-c++src');
                        msg.removeClass('visible').addClass('hidden');
                        break;
                    case "3":
                        editor.setValue("");
                        editor.setOption('mode', 'text/x-python');
                        msg.removeClass('visible').addClass('hidden');
                        break;
                }
            }
        });

        $('#submit').on('click', function () {
            if (language.val().length === 0) {
                $('#null').modal('show').delay(1500).queue(function() {
                    $(this).modal('hide').dequeue();
                });
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/problem/submit',
                data: {
                    'problem_id': '<?= $problem->id ?>',
                    'language': language.val(),
                    'code': editor.getValue()
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.href = "/submission/" + res.data.submission_id;
                    } else {
                        $('#tip_header').text("Error");
                        $('#tip_desc').text(res.message);
                        $('#tip').modal('show');
                    }
                },
                error: function () {
                    $('#tip_header').text("Error");
                    $('#tip_desc').text("Please try later.");
                    $('#tip').modal('show');
                }
            });
        });
    });
</script>