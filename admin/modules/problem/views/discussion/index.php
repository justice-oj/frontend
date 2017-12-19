<?php use admin\widgets\common\PaginationWidget; ?>

<link href="<?= Yii::$app->params['staticFile']['KaTex']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['KaTex']['js'] ?>"></script>
<link href="<?= Yii::$app->params['staticFile']['Quill']['css'] ?>" rel="stylesheet">
<script src="<?= Yii::$app->params['staticFile']['Quill']['js'] ?>"></script>

<h2 class="text-center">Discussions of <code>#<?= /** @var $problem \common\models\Problem */$problem->id ?> <?= $problem->title ?></code></h2>
<div class="row" style="padding-top: 10px">
    <table class="table table-striped">
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-1">User</th>
            <th class="col-md-8">Content</th>
            <th class="col-md-2">Operation</th>
        </tr>
        <?php
        /** @var array $records */
        foreach ($records as $record) {
            /** @lang html */
            echo <<< TESTCASE
    <tr>
        <td>{$record['id']}</td>
        <td><a href="/user?username={$record['username']}">{$record['username']}</a></td>
        <td>
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
        <td>
            <a href="/problem/discussion/edit?discussion_id={$record['id']}"><button type="button" class="btn btn-primary">Edit</button></a>
            <button type="button" class="btn btn-danger remove" data-id="{$record['id']}">Delete</button>
        </td>
    </tr>
TESTCASE;
        }
        ?>
    </table>
</div>
<div class="row text-center">
    <?php /** @var $pagination array */
    try {
        echo PaginationWidget::widget(['pagination' => $pagination]);
    } catch (Exception $e) {
    } ?>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirm_button">Yes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.remove').on('click', function () {
            $('#confirm').val($(this).data('id'));
            $('#modal-title').html('Remove discussion <code>#' + $(this).data('id') + '</code>');
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