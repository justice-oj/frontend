<?php use admin\widgets\common\PaginationWidget; ?>

<h2 class="text-center">Users</h2>
<div>
    <form class="form-inline">
        <div class="form-group col-md-4">
            <label for="id">ID</label>
            <input name="id" class="form-control" id="id" placeholder="ID" value="<?= $id ?>">
        </div>
        <div class="form-group col-md-4">
            <label for="title">Title</label>
            <input name="title" class="form-control" id="title" placeholder="Title" value="<?= $title ?>">
        </div>
        <div class="form-group col-md-2">
            <button class="btn btn-default">Search</button>
        </div>
    </form>
    <a href="/problem/manage/new" target="_blank"><button class="btn btn-success">Add</button></a>
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
        <td><a href="https://www.justice.plus/problem?problem_id={$record->id}" target="_blank">{$record->title}</a></td>
        <td>
            <a href="/problem/manage/edit?problem_id={$record->id}" target="_blank"><button type="button" class="btn btn-primary">Edit</button></a>
            <a href="/problem/submissions/?user_id={$record->id}" target="_blank"><button type="button" class="btn btn-primary">Submissions</button></a>
            <button type="button" class="btn btn-danger">Delete</button>
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