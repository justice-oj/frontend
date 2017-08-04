<?php
$presenter = new \www\presenters\SubmissionPresenter();
?>

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
<table class="ui single line table">
    <thead>
    <tr>
        <th class="one wide">ID</th>
        <th class="three wide">User</th>
        <th class="four wide">Problem</th>
        <th class="one wide">Language</th>
        <th class="one wide">Status</th>
        <th class="one wide">Runtime</th>
        <th class="one wide">Memory</th>
        <th class="two wide">Submit At</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= $submission->id ?></td>
        <td>
            <i class="<?= $user->country ?> flag"></i>
            <a href="/profile/<?= $user->username ?>" target="_blank"><?= $user->username ?></a>
        </td>
        <td><a href="/problem?id=<?= $problem->id ?>" target="_blank"><?= $problem->title ?></a></td>
        <td><?= $presenter->showLanguage($submission->language) ?></td>
        <td><?= $presenter->showStatus($submission->status) ?></td>
        <td><?= $submission->runtime ?> ms</td>
        <td><?= $submission->memory ?> MB</td>
        <td><?= $submission->created_at ?></td>
    </tr>
    </tbody>
</table>
<div class="ui segment">
    <textarea id="editor"><?= $submission->code ?></textarea>
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
        var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
            lineNumbers: true,
            matchBrackets: true,
            readOnly: true,
            indentUnit: 4,
            theme: 'monokai'
        });
        var mode = ['text/x-csrc', 'text/x-c++src', 'text/x-python', 'text/x-python', 'text/x-java'];
        editor.setOption('mode', mode[<?= $submission->language ?>]);
    });
</script>