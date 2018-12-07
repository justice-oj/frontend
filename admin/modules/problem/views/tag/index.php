<input id="problem_id" type="hidden" value="<?= /** @var $problem \common\models\Problem */ $problem->id ?>">
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
                <h2 class="h5 no-margin-bottom">Add tags for problem <code>#<?= $problem->id ?> <?= $problem->title ?></code></h2>
            </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-body">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="tag" class="sr-only">Tag</label>
                                <select id="tag" name="tag" title="tag" class="form-control">
                                    <?php
                                    /** @var array $tags */
                                    foreach ((array)$tags as $tag) {
                                        echo <<<TAG
                    <option value="{$tag['id']}">{$tag['name']}</option>
TAG;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col text-right">
                                <input type="submit" value="Add Tag" id="add" class="btn btn-primary">
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
                                <th class="col-6">Tag Name</th>
                                <th class="col-5">Operation</th>
                            </tr>
                            <?php
                            /** @var array $records */
                            foreach ($records as $record) {
                                echo <<< TAG
    <tr class="d-flex">
        <td class="col-1">{$record['id']}</td>
        <td class="col-6"><span class="label label-default">{$record['name']}</span></td>
        <td class="col-5">
            <button type="button" class="btn btn-danger btn-sm remove" data-id="{$record['id']}" data-name="{$record['name']}">
            Delete
            </button>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="confirm_button">Yes</button>
                        </div>
                    </div>
                </div>
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
        $('#add').on('click', function (e) {
            e.preventDefault();
            var tag_id = $('#tag').val();

            $.ajax({
                type: 'POST',
                url: '/problem/tag/add',
                data: {
                    problem_id: $('#problem_id').val(),
                    tag_id: tag_id
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.reload();
                    } else {
                        toastr["error"](res.message);
                    }
                },
                error: function () {
                    toastr["error"]("An error occurred, please try later.");
                }
            });
        });

        $('.remove').on('click', function () {
            $('#confirm').val($(this).data('id'));
            $('#modal-title').html('Remove tag <code>#' + $(this).data('id') + ' ' + $(this).data('name') + '</code> ?');
            $('#modal').modal();
        });

        $('#confirm_button').on('click', function () {
            $.ajax({
                type: 'POST',
                url: '/problem/tag/delete',
                data: {
                    problem_tag_id: $('#confirm').val()
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