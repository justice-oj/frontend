<?php

use www\widgets\common\GoogleAdSenseWidget;

$presenter = new \www\presenters\SubmissionPresenter();
?>
<link href="<?= Yii::$app->params['staticFile']['CodeMirror']['css'] ?>" rel="stylesheet">
<link href="<?= Yii::$app->params['staticFile']['CodeMirror']['theme'] ?>" rel="stylesheet">
<h2 class="ui header">Submission #<?= /** @var $submission \common\models\Submission */ $submission->id ?></h2>
<div class="ui basic segment">
    <?= /** @noinspection PhpUnhandledExceptionInspection */ GoogleAdSenseWidget::widget() ?>
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
            <i class="<?= /** @var $user \common\models\User */ $user->country ?> flag"></i>
            <a href="/profile?name=<?= $user->username ?>"><?= $user->username ?></a>
        </td>
        <td><a href="/problem?problem_id=<?= /** @var $problem \common\models\Problem */ $problem->id ?>"><?= $problem->title ?></a></td>
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
<textarea id="editor" title="editor"><?= $submission->code ?></textarea>
<div class="ui basic segment">
    <?= /** @noinspection PhpUnhandledExceptionInspection */ GoogleAdSenseWidget::widget() ?>
</div>
<script src="<?= Yii::$app->params['staticFile']['CodeMirror']['js'] ?>"></script>
<script src="<?= Yii::$app->params['staticFile']['CodeMirror']['matchbrackets'] ?>"></script>
<script src="<?= Yii::$app->params['staticFile']['CodeMirror']['clike'] ?>"></script>
<!--suppress CssUnusedSymbol -->
<style>
    .CodeMirror {
        border: 1px solid #eee;
        height: auto;
    }
</style>
<!--suppress JSUnresolvedVariable, JSUnresolvedFunction -->
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
        var mode = ['text/x-csrc', 'text/x-c++src', 'text/x-java'];
        editor.setOption('mode', mode[<?= $submission->language ?>]);
    });
</script>