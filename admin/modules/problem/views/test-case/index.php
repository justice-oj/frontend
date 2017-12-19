<?php use admin\widgets\common\PaginationWidget; ?>

<h2 class="text-center">Test Cases of <code>#<?= /** @var $problem \common\models\Problem */
        $problem->id ?> <?= $problem->title ?></code></h2>
<div>
    <form class="form-inline">
        <input type="hidden" name="problem_id" value="<?= $problem->id ?>">
        <div class="form-group">
            <label for="input">Input</label>
            <input name="input" class="form-control" id="input" placeholder="Input" value="<?= /** @var $input string */
            $input ?>">
        </div>
        <div class="form-group">
            <label for="output">Output</label>
            <input name="output" class="form-control" id="output" placeholder="Output"
                   value="<?= /** @var $output string */
                   $output ?>">
        </div>
        <div class="form-group">
            <button class="btn btn-default">Search</button>
        </div>
        <div class="form-group pull-right">
            <a href="/problem/test-case/new?problem_id=<?= $problem->id ?>" class="btn btn-success">add</a>
        </div>
    </form>
</div>
<div class="row" style="padding-top: 10px">
    <table class="table table-striped">
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-4">Input</th>
            <th class="col-md-4">Output</th>
            <th class="col-md-3">Operation</th>
        </tr>
        <?php
        /** @var \common\models\TestCase[] $records */
        foreach ($records as $record) {
            echo <<< TESTCASE
    <tr>
        <td>{$record->id}</td>
        <td><pre>{$record->input}</pre></td>
        <td><pre>{$record->output}</pre></td>
        <td>
            <a href="/problem/test-case/edit?id={$record->id}"><button type="button" class="btn btn-primary">Edit</button></a>
            <button type="button" class="btn btn-danger remove" data-id="{$record->id}" data-input="{$record->input}" data-output="{$record->output}">Delete</button>
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
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <pre id="i"></pre>
                    </div>
                    <div class="col-md-6">
                        <pre id="o"></pre>
                    </div>
                </div>
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