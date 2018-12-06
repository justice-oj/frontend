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
                <h2 class="h5 no-margin-bottom">Problems</h2>
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
                                <label for="title" class="sr-only">Title</label>
                                <input id="title" name="title" type="text" value="<?= /* @var $title string */ $title ?>" placeholder="Title" class="mr-sm-2 form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Search" class="btn btn-primary">
                            </div>
                            <div class="col text-right">
                                <a href="/problem/manage/new" class="btn btn-outline-primary">Add</a>
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
                                <th class="col-5">Title</th>
                                <th class="col-6">Operation</th>
                            </tr>
                            <?php
                            /** @var array $records */
                            foreach ($records as $record) {
                                echo <<< USER
    <tr class="d-flex">
        <td class="col-1">{$record->id}</td>
        <td class="col-5"><a href="https://www.justice.plus/problem?problem_id={$record->id}">{$record->title}</a></td>
        <td class="col-6">
            <a href="/problem/manage/edit?problem_id={$record->id}"><button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
            <a href="/problem/test-case?problem_id={$record->id}"><button type="button" class="btn btn-outline-primary btn-sm">Test Cases</button></a>
            <a href="/problem/tag?problem_id={$record->id}"><button type="button" class="btn btn-outline-primary btn-sm">Tags</button></a>
            <a href="/problem/discussion?problem_id={$record->id}"><button type="button" class="btn btn-outline-primary btn-sm">Discussions</button></a>
            <a href="/problem/editorial?problem_id={$record->id}"><button type="button" class="btn btn-outline-primary btn-sm">Editorial</button></a>
            <button type="button" class="btn btn-danger btn-sm remove" data-problem-id="{$record->id}" data-problem-title="{$record->title}">Delete</button>
        </td>
    </tr>
USER;
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
                                <li>Test cases of this problem</li>
                                <li>Submissions of this problem</li>
                                <li>Editorial of this problem</li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="confirm_button">OK</button>
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
            $('#confirm').val($(this).data('problem-id'));
            $('#modal-title').html('Remove problem <code>#' + $(this).data('problem-id') + ' ' + $(this).data('problem-title') + '</code>');
            $('#modal').modal();
        });

        $('#confirm_button').on('click', function () {
            $.ajax({
                type: 'POST',
                url: '/problem/manage/delete',
                data: {
                    problem_id: $('#confirm').val()
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.reload();
                    } else {
                        alert(res.message);
                        $('#modal').modal('hide');
                    }
                },
                error: function () {
                    alert("An error occurred, please try later.");
                    $('#modal').modal('hide');
                }
            });
        });
    });
</script>