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
                <h2 class="h5 no-margin-bottom">Test Cases of <code>#<?= /** @var $problem \common\models\Problem */ $problem->id ?> <?= $problem->title ?></code></h2>
            </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-body">
                        <form class="form-inline">
                            <input type="hidden" name="problem_id" value="<?= $problem->id ?>">
                            <div class="form-group">
                                <label for="input" class="sr-only">Input</label>
                                <input name="input" type="text" class="mr-sm-2 form-control" id="input" placeholder="Input" value="<?= /** @var $input string */ $input ?>">
                            </div>
                            <div class="form-group">
                                <label for="output" class="sr-only">Output</label>
                                <input name="output" type="text" class="mr-sm-2 form-control" id="output" placeholder="Output" value="<?= /** @var $output string */ $output ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Search" class="btn btn-primary">
                            </div>
                            <div class="col text-right">
                                <a href="/problem/test-case/new?problem_id=<?= $problem->id ?>" class="btn btn-outline-primary">Add</a>
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
                                <th class="col-4">Input</th>
                                <th class="col-4">Output</th>
                                <th class="col-3">Operation</th>
                            </tr>
                            <?php
                            /** @var \common\models\TestCase[] $records */
                            foreach ($records as $record) {
                                echo <<< TESTCASE
    <tr class="d-flex">
        <td class="col-1">{$record->id}</td>
        <td class="col-4"><pre>{$record->input}</pre></td>
        <td class="col-4"><pre>{$record->output}</pre></td>
        <td class="col-3">
            <a href="/problem/test-case/edit?id={$record->id}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
            <button type="button" class="btn btn-danger btn-sm remove" data-id="{$record->id}" data-input="{$record->input}" data-output="{$record->output}">Delete</button>
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
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    Input: <pre id="i"></pre>
                                </div>
                                <div class="col-md-6">
                                    Output: <pre id="o"></pre>
                                </div>
                            </div>
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
            $('#modal-title').html('Remove test case <code>#' + $(this).data('id') + '</code>');
            $('#i').html($(this).data('input'));
            $('#o').html($(this).data('output'));
            $('#modal').modal();
        });

        $('#confirm_button').on('click', function () {
            $.ajax({
                type: 'POST',
                url: '/problem/test-case/delete',
                data: {
                    test_case_id: $('#confirm').val()
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