<link href="<?= Yii::$app->params['staticFile']['KaTex']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['KaTex']['js'] ?>"></script>
<link href="<?= Yii::$app->params['staticFile']['Quill']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['Quill']['js'] ?>"></script>

<h2 class="text-center">Update Discussion <code>#<?= /** @var $discussion \common\models\Discussion */ $discussion->id ?></code> of Problem <code><?= /** @var $problem \common\models\Problem */ $problem->title ?></code></h2>
<input id="discussion_id" type="hidden" value="<?= $discussion->id ?>">
<form>
    <div class="row form-group">
        <label for="discussion">Discussion</label>
        <input name="discussion" type="hidden">
        <div id="discussion" style="height: 400px"></div>
    </div>
    <div class="row">
        <button class="btn btn-primary" id="submit">Update Discussion</button>
    </div>
</form>
<div class="modal fade" id="error" tabindex="-1" role="dialog" style="padding-top: 15%">
    <div class="modal-dialog modal-sm" role="document">
        <div id="error_message" class="alert alert-danger" role="alert"></div>
    </div>
</div>
<!--suppress JSUnresolvedFunction -->
<script>
    $(document).ready(function () {
        var quill = new Quill('#discussion', {
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
            placeholder: 'Update problem\'s discussion here...',
            theme: 'snow'
        });
        quill.setContents(<?= $discussion->content ?>);

        $('#submit').on('click', function (event) {
            event.preventDefault();

            var content = JSON.stringify(quill.getContents()),
                error_message = $('#error_message'),
                error = $('#error');

            if (content.length === 0) {
                error_message.text("editorial can not be empty");
                error.modal();
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/problem/discussion/update',
                data: {
                    discussion_id: $('#discussion_id').val(),
                    content: content
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.reload();
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