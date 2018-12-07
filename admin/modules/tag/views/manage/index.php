<?php use admin\widgets\common\PaginationWidget; ?>

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
            <li>
                <a href="/problem"> <i class="fa fa-question-circle"></i>Problem</a>
            </li>
            <li class="active">
                <a href="/tag"> <i class="fa fa-tags"></i>Tag</a>
            </li>
        </ul>
    </nav>
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Tags</h2>
            </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-body">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="id" class="sr-only">ID</label>
                                <input id="id" name="id" type="text" value="<?= /* @var $id integer */ $id ?>" placeholder="ID" class="mr-sm-2 form-control">
                            </div>
                            <div class="form-group">
                                <label for="name" class="sr-only">Name</label>
                                <input id="name" name="name" type="text" value="<?= /* @var $name string */ $name ?>" placeholder="Name" class="mr-sm-2 form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Search" class="btn btn-primary">
                            </div>
                            <div class="col text-right">
                                <a href="/tag/manage/new" class="btn btn-outline-primary">Add</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="no-padding-top no-padding-bottom">
            <div class="col-lg-12">
                <div class="block">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr class="d-flex">
                                <th class="col-1">#</th>
                                <th class="col-8">Name</th>
                                <th class="col-3">Operation</th>
                            </tr>
                            <?php
                            /** @var \common\models\Tag[] $records */
                            foreach ($records as $record) {
                                echo <<< TAG
    <tr class="d-flex">
        <td class="col-1">{$record->id}</td>
        <td class="col-8">{$record->name}</td>
        <td class="col-3">
            <a href="/tag/manage/edit?tag_id={$record->id}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
            <button type="button" class="btn btn-danger btn-sm remove" data-tag-id="{$record->id}" data-tag-name="{$record->name}">Delete</button>
        </td>
    </tr>
TAG;
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
                        <div class="modal-body">
                            <h4>Items below will also be removed:</h4>
                            <ul>
                                <li>Relations of problems and this tag</li>
                            </ul>
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
            $('#confirm').val($(this).data('tag-id'));
            $('#modal-title').html('Remove tag <code>#' + $(this).data('tag-id') + ' ' + $(this).data('tag-name') + '</code> ?');
            $('#modal').modal();
        });

        $('#confirm_button').on('click', function () {
            $.ajax({
                type: 'POST',
                url: '/tag/manage/delete',
                data: {
                    tag_id: $('#confirm').val()
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