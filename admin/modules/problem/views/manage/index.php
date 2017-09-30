<?php use admin\widgets\common\PaginationWidget; ?>

<h2 class="text-center">Problems</h2>
<div>
    <form class="form-inline">
        <div class="form-group">
            <label for="id">ID</label>
            <input name="id" class="form-control" id="id" placeholder="ID" value="<?= $id ?>">
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" class="form-control" id="title" placeholder="Title" value="<?= $title ?>">
        </div>
        <div class="form-group">
            <button class="btn btn-default">Search</button>
        </div>
        <div class="form-group pull-right">
            <a href="/problem/manage/new" class="btn btn-success">add</a>
        </div>
    </form>
</div>
<div class="row" style="padding-top: 10px">
    <table class="table table-striped">
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-6">Title</th>
            <th class="col-md-5">Operation</th>
        </tr>
        <?php
        foreach ($records as $record) {
            echo <<< USER
    <tr>
        <td>{$record->id}</td>
        <td><a href="https://www.justice.plus/problem?problem_id={$record->id}">{$record->title}</a></td>
        <td>
            <a href="/problem/manage/edit?problem_id={$record->id}"><button type="button" class="btn btn-primary btn-xs">Edit</button></a>
            <a href="/problem/test-case?problem_id={$record->id}"><button type="button" class="btn btn-primary btn-xs">Test Cases</button></a>
            <a href="/problem/tag?problem_id={$record->id}"><button type="button" class="btn btn-primary btn-xs">Tags</button></a>
            <a href="/problem/discussion?problem_id={$record->id}"><button type="button" class="btn btn-primary btn-xs">Discussions</button></a>
            <a href="/problem/editorial?problem_id={$record->id}"><button type="button" class="btn btn-primary btn-xs">Editorial</button></a>
            <button type="button" class="btn btn-danger btn-xs remove" data-problem-id="{$record->id}" data-problem-title="{$record->title}">Delete</button>
        </td>
    </tr>
USER;
        }
        ?>
    </table>
</div>
<div class="row text-center">
    <?= PaginationWidget::widget(['pagination' => $pagination]) ?>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal" style="padding-top: 10%">
    <input type="hidden" id="confirm">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
                <h2 class="modal-title" id="modal-title"></h2>
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
                <button type="button" class="btn btn-danger" id="confirm_button">Yes</button>
            </div>
        </div>
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