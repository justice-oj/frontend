<link href="https://cdn.quilljs.com/1.3.1/quill.snow.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.1/quill.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>

<h2 class="text-center">Update Editorial for <code>#<?= $problem->id ?> <?= $problem->title ?></code></h2>
<input id="problem_id" type="hidden" value="<?= $problem->id ?>">
<form>
    <div class="row form-group">
        <label for="editorial">Editorial</label>
        <input name="editorial" type="hidden">
        <div id="editorial" style="height: 400px"></div>
    </div>
    <div class="row">
        <button class="btn btn-primary" id="submit">Update Editorial</button>
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
            placeholder: 'Update problem\'s editorial here...',
            theme: 'snow'
        });
        quill.setContents(<?= $editorial->content ?>);

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
                url: '/problem/editorial/update',
                data: {
                    problem_id: $('#problem_id').val(),
                    editorial: editorial
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