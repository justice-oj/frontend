<link href="<?= Yii::$app->params['staticFile']['KaTex']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['KaTex']['js'] ?>"></script>
<link href="<?= Yii::$app->params['staticFile']['Quill']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['Quill']['js'] ?>"></script>

<h2 class="text-center">Update Problem</h2>
<input type="hidden" id="problem_id" value="<?= $problem->id ?>">
<form>
    <div class="row form-group">
        <label for="Title">Title</label>
        <input class="form-control" name="title" id="title" placeholder="problem's title" value="<?= $problem->title ?>">
    </div>
    <div class="row form-group">
        <label for="description">Description</label>
        <input name="description" type="hidden">
        <div id="editor" style="height: 400px"></div>
    </div>
    <div class="row form-group">
        <label for="runtime">Runtime Limitation (ms)</label>
        <input class="form-control" name="runtime" id="runtime" type="number" value="<?= $problem->runtime_limit ?>">
    </div>
    <div class="row form-group">
        <label for="memory">Memory (MB)</label>
        <input class="form-control" name="memory" id="memory" type="number" value="<?= $problem->memory_limit ?>">
    </div>
    <div class="row form-group">
        <label for="level">Level</label>
        <input class="form-control" name="level" id="level" type="number" min="1" max="10" value="<?= $problem->level ?>">
    </div>
    <div class="row">
        <button class="btn btn-primary" id="submit">Update Problem</button>
    </div>
</form>
<div class="modal fade" id="error" tabindex="-1" role="dialog" style="padding-top: 15%">
    <div class="modal-dialog modal-sm" role="document">
        <div id="error_message" class="alert alert-danger" role="alert"></div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var quill = new Quill('#editor', {
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
        quill.setContents(<?= $problem->description ?>);

        $('#submit').on('click', function (event) {
            event.preventDefault();

            var title = $('#title').val(),
                description = JSON.stringify(quill.getContents()),
                level = $('#level').val(),
                runtime_limit = $('#runtime').val(),
                memory_limit = $('#memory').val(),
                error_message = $('#error_message'),
                error = $('#error');

            if (title.length === 0
                || quill.getText().trim().length === 0
                || level.length === 0
                || runtime_limit.length === 0
                || memory_limit.length === 0) {
                error_message.text("please fill all the blanks");
                error.modal();
                return;
            }

            console.log(description);

            $.ajax({
                type: 'POST',
                url: '/problem/manage/update',
                data: {
                    problem_id: $('#problem_id').val(),
                    title: title,
                    description: description,
                    level: level,
                    runtime_limit: runtime_limit,
                    memory_limit: memory_limit
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.href = "/problem/manage/edit?problem_id=" + res.data.problem_id;
                    } else {
                        error_message.text(res.message);
                        error.modal();
                    }
                },
                error: function () {
                    error_message.text("An error occurred, please try later.");
                    error.modal();
                }
            });
        });
    });
</script>