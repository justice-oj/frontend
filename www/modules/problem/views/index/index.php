<?php

use www\widgets\common\GoogleAdSenseWidget;

?>

<link href="<?= Yii::$app->params['staticFile']['CodeMirror']['css'] ?>" rel="stylesheet">
<link href="<?= Yii::$app->params['staticFile']['CodeMirror']['theme'] ?>" rel="stylesheet">
<link href="<?= Yii::$app->params['staticFile']['KaTex']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['KaTex']['js'] ?>"></script>
<link href="<?= Yii::$app->params['staticFile']['Quill']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['Quill']['js'] ?>"></script>
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
<div class="ui segment">
    <div class="ui list">
        <div class="item">
            <i class="microchip icon"></i>
            <div class="content">
                <b>Time Limit: <?= $problem->runtime_limit ?> ms</b>
            </div>
        </div>
        <div class="item">
            <i class="server icon"></i>
            <div class="content">
                <b>Memory Limit: <?= $problem->memory_limit ?> MB</b>
            </div>
        </div>
    </div>
    <div class="ui accordion">
        <div class="title">
            <i class="dropdown icon"></i>
            Click to show / hide problem tags:
        </div>
        <div class="content">
            <div class="ui tag labels">
                <?php
                foreach ((array)$tags as $tag) {
                    echo <<<TAG
                    <a class="ui mini tag label">{$tag['name']}</a>
TAG;
                }
                ?>
            </div>
        </div>
    </div>
</div>
<input name="description" type="hidden">
<div id="description"></div>
<h4 class="ui horizontal divider header">
    <i class="write icon"></i>
</h4>
<div class="fields">
    <div class="four wide field">
        <select class="ui dropdown" id="language">
            <option value="">Select Language</option>
            <option value="<?= \common\models\Submission::LANGUAGE_C ?>">C</option>
            <option value="<?= \common\models\Submission::LANGUAGE_CPP ?>">C++</option>
            <option value="<?= \common\models\Submission::LANGUAGE_JAVA ?>">Java</option>
        </select>
    </div>
</div>
<h4 class="ui header">Paste your source code:</h4>
<textarea id="editor"></textarea>
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
<script src="<?= Yii::$app->params['staticFile']['CodeMirror']['js'] ?>"></script>
<script src="<?= Yii::$app->params['staticFile']['CodeMirror']['matchbrackets'] ?>"></script>
<script src="<?= Yii::$app->params['staticFile']['CodeMirror']['clike'] ?>"></script>
<script>
    $(document).ready(function () {
        $('.menu .item').tab();
        $('.ui.accordion').accordion();

        var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
            lineNumbers: true,
            lineWrapping: true,
            matchBrackets: true,
            indentUnit: 4,
            theme: 'monokai'
        });
        editor.setSize('auto', 500);

        var language = $('#language');
        language.dropdown({
            onChange: function (val) {
                switch (val) {
                    case "<?= \common\models\Submission::LANGUAGE_C ?>":
                        editor.setValue(
                            "#include <stdio.h>\n" +
                            "\n" +
                            "int main() {\n" +
                            "    /* Enter your code here. Read input from STDIN. Print output to STDOUT */\n" +
                            "    return 0;\n" +
                            "}"
                        );
                        editor.setOption('mode', 'text/x-csrc');
                        break;
                    case "<?= \common\models\Submission::LANGUAGE_CPP ?>":
                        editor.setValue(
                            "#include <iostream>\n" +
                            "\n" +
                            "using namespace std;\n" +
                            "int main() {\n" +
                            "    /* Enter your code here. Read input from STDIN. Print output to STDOUT */\n" +
                            "    return 0;\n" +
                            "}"
                        );
                        editor.setOption('mode', 'text/x-c++src');
                        break;
                    case "<?= \common\models\Submission::LANGUAGE_JAVA ?>":
                        editor.setValue(
                            "import java.io.*;\n" +
                            "import java.util.*;\n" +
                            "\n" +
                            "public class Main {\n" +
                            "    public static void main(String args[] ) throws Exception {\n" +
                            "        /* Enter your code here. Read input from STDIN. Print output to STDOUT */\n" +
                            "    }\n" +
                            "}"
                        );
                        editor.setOption('mode', 'text/x-java');
                        break;
                }
            }
        });

        var quill = new Quill('#description', {
            modules: {
                toolbar: null
            },
            readOnly: true,
            theme: 'snow'
        });
        quill.setContents(<?= $problem->description ?>);

        $('#submit').on('click', function () {
            if (language.val().length === 0) {
                $('#null').modal('show').delay(1500).queue(function () {
                    $(this).modal('hide').dequeue();
                });
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/problem/index/submit',
                data: {
                    problem_id: '<?= $problem->id ?>',
                    language: language.val(),
                    code: editor.getValue()
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.href = "/submission?id=" + res.data.submission_id;
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

        $('.toggle_tags').on('click', function () {
            $('.toggle_tags > a').each(function () {
                if ($(this).hasClass('hidden')) {
                    $(this).removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                }
            });
        });
    });
</script>