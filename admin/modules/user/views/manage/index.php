<?php use admin\widgets\common\PaginationWidget; ?>

<h2 class="text-center">Users</h2>
<div>
    <form class="form-inline">
        <div class="form-group">
            <label for="id">ID</label>
            <input name="id" class="form-control" id="id" placeholder="ID" value="<?= $id ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" class="form-control" id="email" placeholder="Email" value="<?= $email ?>">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input name="username" class="form-control" id="username" placeholder="Username" value="<?= $username ?>">
        </div>
        <div class="form-group">
            <button class="btn btn-default">Search</button>
        </div>
        <div class="form-group pull-right">
            <a href="/user/manage/new" class="btn btn-success">add</a>
        </div>
    </form>
</div>
<div class="row" style="padding-top: 10px">
    <table class="table table-striped">
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-3">Username</th>
            <th class="col-md-3">Email</th>
            <th class="col-md-5">Operation</th>
        </tr>
        <?php
        foreach ($records as $record) {
            echo <<< USER
    <tr>
        <td>{$record->id}</td>
        <td>{$record->username}</td>
        <td>{$record->email}</td>
        <td>
            <a href="/user/manage/edit?user_id={$record->id}"><button type="button" class="btn btn-primary btn-xs">Edit</button></a>
            <button type="button" class="btn btn-danger btn-xs remove" data-user-id="{$record->id}" data-user-name="{$record->username}">Delete</button>
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
                    <li>Submissions of this user</li>
                    <li>Discussions of this user</li>
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
            $('#confirm').val($(this).data('user-id'));
            $('#modal-title').html('Remove user <code>#' + $(this).data('user-id') + ' ' + $(this).data('user-name') + '</code>');
            $('#modal').modal();
        });

        $('#confirm_button').on('click', function () {
            $.ajax({
                type: 'POST',
                url: '/user/manage/delete',
                data: {
                    user_id: $('#confirm').val()
                },
                timeout: 3000,
                done: function (res) {
                    if (res.code === 0) {
                        location.reload();
                    } else {
                        alert(res.message);
                        $('#modal').modal('hide');
                    }
                },
                fail: function () {
                    alert("An error occurred, please try later.");
                    $('#modal').modal('hide');
                }
            });
        });
    });
</script>