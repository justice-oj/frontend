<link href="<?= Yii::$app->params['staticFile']['KaTex']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['KaTex']['js'] ?>"></script>
<link href="<?= Yii::$app->params['staticFile']['Quill']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['Quill']['js'] ?>"></script>

<h2 class="text-center">Add Editorial for <code>#<?= $problem->id ?> <?= $problem->title ?></code></h2>
<input id="problem_id" type="hidden" value="<?= $problem->id ?>">
<form>
    <div class="row form-group">
        <label for="editorial">Editorial</label>
        <input name="editorial" type="hidden">
        <div id="editorial" style="height: 400px"></div>
    </div>
    <div class="row">
        <button class="btn btn-primary" id="submit">Add Editorial</button>
    </div>
</form>
<script>
    $(document).ready(function () {
        var quill = new Quill('#editorial', {
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
            placeholder: 'Add problem\'s editorial here...',
            theme: 'snow'
        });

        $('#submit').on('click', function (event) {
            event.preventDefault();

            var editorial = JSON.stringify(quill.getContents()),
                error_message = $('#error_message'),
                error = $('#error');

            if (editorial.length === 0) {
                error_message.text("editorial can not be empty");
                error.modal();
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/problem/editorial/add',
                data: {
                    problem_id: $('#problem_id').val(),
                    editorial: editorial
                },
                timeout: 3000,
                done: function (res) {
                    if (res.code === 0) {
                        location.reload();
                    } else {
                        error_message.text(res.message);
                        error.modal();
                    }
                },
                fail: function () {
                    error_message.text("An error occurred, please try later.");
                    error.modal();
                }
            });
        });
    });
</script>