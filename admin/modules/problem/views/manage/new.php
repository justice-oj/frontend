<link href="<?= Yii::$app->params['staticFile']['KaTex']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['KaTex']['js'] ?>"></script>
<link href="<?= Yii::$app->params['staticFile']['Quill']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['Quill']['js'] ?>"></script>
<style>
    .ql-toolbar.ql-snow{
        background-color: #2d3035;
        border: 1px solid violet;
    }

    .ql-container.ql-snow{
        background-color: #2d3035;
        border: 1px solid violet;
        color:violet;
    }

    .ql-snow .ql-fill, .ql-snow .ql-stroke.ql-fill {
        fill: violet;
    }

    .ql-snow .ql-picker{
        color:violet;
    }

    .ql-snow .ql-picker.ql-expanded .ql-picker-label .ql-stroke {
        stroke: violet;
    }

    .ql-snow .ql-toolbar.snow, .ql-snow .ql-stroke{
        stroke:violet;
    }

    .ql-editor.ql-blank::before {
        color: violet;
    }
</style>

<div class="d-flex align-items-stretch">
    <nav id="sidebar">
        <span class="heading">Main</span>
        <ul class="list-unstyled">
            <li>
                <a href="/"> <i class="fa fa-tachometer"></i>Dashboard</a>
            </li>
        </ul>
        <span class="heading">Management</span>
        <ul class="list-unstyled">
            <li>
                <a href="/user"> <i class="fa fa-user-circle"></i>User</a>
            </li>
            <li class="active">
                <a href="/problem"> <i class="fa fa-question-circle"></i>Problem</a>
            </li>
            <li>
                <a href="/tag"> <i class="fa fa-tags"></i>Tag</a>
            </li>
        </ul>
    </nav>
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Add Problem</h2>
            </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-body">
                        <form>
                            <div class="form-group">
                                <label for="title" class="sr-only">Title</label>
                                <input id="title" name="title" type="text" placeholder="Title" class="mr-sm-2 form-control">
                            </div>
                            <div class="form-group">
                                <label for="description" class="sr-only">Description</label>
                                <input name="description" type="hidden">
                                <div id="editor" style="height: 400px"></div>
                            </div>
                            <div class="form-group">
                                <label for="runtime" class="sr-only">Runtime Limitation (ms)</label>
                                <input id="runtime" name="runtime" type="number" min="1" placeholder="Runtime Limitation (ms)" class="mr-sm-2 form-control">
                            </div>
                            <div class="form-group">
                                <label for="memory" class="sr-only">Memory (MB)</label>
                                <input id="memory" name="memory" type="number" min="1" placeholder="Memory (MB)" class="mr-sm-2 form-control">
                            </div>
                            <div class="form-group">
                                <label for="level" class="sr-only">Level</label>
                                <input id="level" name="level" type="number" min="1" max="10" placeholder="Level" class="mr-sm-2 form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" id="submit">Add Problem</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="error_message">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="footer__block block no-margin-bottom">
                <div class="container-fluid text-center">
                    <p class="no-margin-bottom"><script>document.write((new Date()).getFullYear() + "");</script> &copy; Justice PLUS. Design by <a href="https://bootstrapious.com">Bootstrapious</a>.
                    </p>
                </div>
            </div>
        </footer>
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
            placeholder: 'Add problem\'s description here...',
            theme: 'snow'
        });

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
                error_message.text("Please fill all the blanks");
                error.modal();
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/problem/manage/add',
                data: {
                    title: title,
                    description: description,
                    level: level,
                    runtime_limit: runtime_limit,
                    memory_limit: memory_limit
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.href = '/problem';
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