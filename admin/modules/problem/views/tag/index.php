<h2 class="text-center">Tags of <code>#<?= $problem->id ?> <?= $problem->title ?></code></h2>
<input id="problem_id" type="hidden" value="<?= $problem->id ?>">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Add tag for problem</h3>
    </div>
    <div class="panel-body">
        <div class="col-md-6">
            <div class="row">
                <select id="tag" class="form-control">
                    <?php
                    foreach ((array)$tags as $tag) {
                        echo <<<TAG
                    <option value="{$tag['id']}">{$tag['name']}</option>
TAG;
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <a class="btn btn-success" id="add">add</a>
        </div>
    </div>
</div>
<div class="row" style="padding-top: 10px">
    <table class="table table-striped">
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-6">Tag Name</th>
            <th class="col-md-5">Operation</th>
        </tr>
        <?php
        foreach ($records as $record) {
            echo <<< TAG
    <tr>
        <td>{$record['id']}</td>
        <td><span class="label label-default">{$record['name']}</span></td>
        <td>
            <button type="button" class="btn btn-danger btn-xs remove" data-id="{$record['id']}" data-name="{$record['name']}">
            Delete
            </button>
        </td>
    </tr>
TAG;
        }
        ?>
    </table>
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
                <span class="label label-default" id="l"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirm_button">Yes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#add').on('click', function () {
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
                        alert(res.message);
                    }
                },
                error: function () {
                    alert("An error occurred, please try later.");
                }
            });
        });

        $('.remove').on('click', function () {
            $('#confirm').val($(this).data('id'));
            $('#modal-title').html('Remove tag <code>#' + $(this).data('id') + '</code> from problem');
            $('#l').html($(this).data('name'));
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