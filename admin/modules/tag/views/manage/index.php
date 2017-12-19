<?php use admin\widgets\common\PaginationWidget; ?>

<h2 class="text-center">Tags</h2>
<div>
    <form class="form-inline">
        <div class="form-group">
            <label for="id">ID</label>
            <input name="id" class="form-control" id="id" placeholder="ID" value="<?= /* @var $id integer */ $id ?>">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" class="form-control" id="name" placeholder="Name" value="<?= /* @var $name string */  $name ?>">
        </div>
        <div class="form-group">
            <button class="btn btn-default">Search</button>
        </div>
        <div class="form-group pull-right">
            <a href="/tag/manage/new" class="btn btn-success">add</a>
        </div>
    </form>
</div>
<div class="row" style="padding-top: 10px">
    <table class="table table-striped">
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-8">Name</th>
            <th class="col-md-3">Operation</th>
        </tr>
        <?php
        /** @var \common\models\Tag[] $records */
        foreach ($records as $record) {
            echo <<< TAG
    <tr>
        <td>{$record->id}</td>
        <td>{$record->name}</td>
        <td>
            <a href="/tag/manage/edit?tag_id={$record->id}"><button type="button" class="btn btn-primary btn-xs">Edit</button></a>
            <button type="button" class="btn btn-danger btn-xs remove" data-tag-id="{$record->id}" data-tag-name="{$record->name}">Delete</button>
        </td>
    </tr>
TAG;
        }
        ?>
    </table>
</div>
<div class="row text-center">
    <?= /** @var $pagination array */
    /** @noinspection PhpUnhandledExceptionInspection */
    PaginationWidget::widget(['pagination' => $pagination]) ?>
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
                    <li>Relations of problems and this tag</li>
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
            $('#confirm').val($(this).data('tag-id'));
            $('#modal-title').html('Remove tag <code>#' + $(this).data('tag-id') + ' ' + $(this).data('tag-name') + '</code>');
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