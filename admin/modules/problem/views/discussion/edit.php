<input id="discussion_id" type="hidden" value="<?= /** @var $discussion \common\models\Discussion */ $discussion->id ?>">

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
                <h2 class="h5 no-margin-bottom">Update Discussion <code>#<?= $discussion->id ?></code> of Problem <code><?= /** @var $problem \common\models\Problem */ $problem->title ?></code></h2>
            </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-body">
                        <form>
                            <div class="form-group">
                                <label for="discussion" class="sr-only">Discussion</label>
                                <input name="discussion" type="hidden">
                                <div id="discussion" style="height: 400px"></div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" id="submit">Update Discussion</button>
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
                        toastr["success"]("Success!");
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