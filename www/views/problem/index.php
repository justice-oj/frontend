<link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.28.0/codemirror.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.28.0/theme/monokai.min.css" rel="stylesheet">
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
<div class="ui items">
    <div class="item">
        <div class="content">
            <a class="header">Description</a>
            <div class="description">
                <?= $problem->description ?>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="content">
            <a class="header">Input</a>
            <div class="description">
                <?= $problem->input ?>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="content">
            <a class="header">Output</a>
            <div class="description">
                <?= $problem->output ?>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="content">
            <div class="description">
                <div class="ui two column relaxed grid">
                    <div class="eight wide column">
                        <div class="ui segment">
                            <div class="ui top tiny attached button" tabindex="0">Sample Input</div>
                            <pre><?= $problem->sample_input ?></pre>
                        </div>
                    </div>
                    <div class="eight wide column">
                        <div class="ui segment">
                            <div class="ui top tiny attached button" tabindex="0">Sample Output</div>
                            <pre><?= $problem->sample_output ?></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<div class="ui segment">
    <textarea id="editor" rows="5"></textarea>
</div>
<button class="ui primary basic button" id="submit">Submit</button>
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
                        editor.setValue("public class Main {\n    public static void main() {\n        \n    }\n}");
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