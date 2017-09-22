<?php

use www\widgets\common\GoogleAdSenseWidget;

$presenter = new \www\presenters\SubmissionPresenter();
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.30.0/codemirror.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.30.0/theme/monokai.min.css" rel="stylesheet">
<h2 class="ui header">Submission #<?= $submission->id ?></h2>
<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget() ?>
</div>
<table class="ui single line table">
    <thead>
    <tr>
        <th class="two wide">User</th>
        <th class="four wide">Problem</th>
        <th class="one wide">Language</th>
        <th class="two wide">Status</th>
        <th class="one wide">Time</th>
        <th class="one wide">Memory</th>
        <th class="two wide">Submit Time</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <i class="<?= $user->country ?> flag"></i>
            <a href="/profile?name=<?= $user->username ?>"><?= $user->username ?></a>
        </td>
        <td><a href="/problem?problem_id=<?= $problem->id ?>"><?= $problem->title ?></a></td>
        <td><?= $presenter->showLanguage($submission->language) ?></td>
        <td><?= $presenter->showStatus($submission->status) ?></td>
        <td><?= $presenter->showRuntime($submission->runtime) ?></td>
        <td><?= $presenter->showMemory($submission->memory) ?></td>
        <td><?= $submission->created_at ?></td>
    </tr>
    </tbody>
</table>
<?= $presenter->showWAMessage($submission) ?>
<?= $presenter->showErrorMessage($submission) ?>
<textarea id="editor"><?= $submission->code ?></textarea>
<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget() ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.30.0/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.30.0/addon/edit/matchbrackets.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.30.0/mode/clike/clike.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.30.0/mode/python/python.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.30.0/mode/perl/perl.min.js"></script>
<style>
    .CodeMirror {
        border: 1px solid #eee;
        height: auto;
    }
</style>
<script>
    $(document).ready(function () {
        var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
            lineNumbers: true,
            lineWrapping: true,
            matchBrackets: true,
            readOnly: true,
            indentUnit: 4,
            theme: 'monokai'
        });
        var mode = ['text/x-csrc', 'text/x-c++src', 'text/x-python', 'text/x-python', 'text/x-java'];
        editor.setOption('mode', mode[<?= $submission->language ?>]);
    });
</script>