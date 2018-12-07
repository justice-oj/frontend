<?php use admin\widgets\common\PaginationWidget; ?>

<link href="<?= Yii::$app->params['staticFile']['KaTex']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['KaTex']['js'] ?>"></script>
<link href="<?= Yii::$app->params['staticFile']['Quill']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['Quill']['js'] ?>"></script>
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
                <h2 class="h5 no-margin-bottom">Discussions of <code>#<?= /** @var $problem \common\models\Problem */$problem->id ?> <?= $problem->title ?></code></h2>
            </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
            <div class="col-lg-12">
                <div class="block">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr class="d-flex">
                                <th class="col-1">#</th>
                                <th class="col-1">User</th>
                                <th class="col-8">Content</th>
                                <th class="col-2">Operation</th>
                            </tr>
                            <?php
                            /** @var array $records */
                            foreach ($records as $record) {
                                /** @lang html */
                                echo <<< TESTCASE
    <tr class="d-flex">
        <td class="col-1">{$record['id']}</td>
        <td class="col-1"><a href="/user?username={$record['username']}">{$record['username']}</a></td>
        <td class="col-8">
            <div id="quill_{$record['id']}"></div>
            <script>
            var quill_{$record['id']} = new Quill('#quill_{$record['id']}', {
                modules: {toolbar: null},
                readOnly: true,
                theme: 'snow'
            });
            quill_{$record['id']}.setContents({$record['content']});
            </script>
        </td>
        <td class="col-2">
            <a href="/problem/discussion/edit?discussion_id={$record['id']}"><button type="button" class="btn btn-sm btn-outline-primary">Edit</button></a>
            <button type="button" class="btn btn-danger btn-sm remove" data-id="{$record['id']}">Delete</button>
        </td>
    </tr>
TESTCASE;
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                <input type="hidden" id="confirm">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="confirm_button">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="no-padding-top no-padding-bottom">
            <div class="col-lg-12">
                <?= /** @var $pagination array */
                /** @noinspection PhpUnhandledExceptionInspection */
                PaginationWidget::widget(['pagination' => $pagination]) ?>
            </div>
        </section>
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
        $('.remove').on('click', function () {
            $('#confirm').val($(this).data('id'));
            $('#modal-title').html('Remove discussion <code>#' + $(this).data('id') + '</code> ?');
            $('#modal').modal();
        });

        $('#confirm_button').on('click', function () {
            $.ajax({
                type: 'POST',
                url: '/problem/discussion/delete',
                data: {
                    discussion_id: $('#confirm').val()
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.reload();
                    } else {
                        toastr["error"](res.message);
                        $('#modal').modal('hide');
                    }
                },
                error: function () {
                    toastr["error"]("An error occurred, please try later.");
                    $('#modal').modal('hide');
                }
            });
        });
    });
</script>