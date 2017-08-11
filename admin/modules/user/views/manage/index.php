<?php use admin\widgets\common\PaginationWidget; ?>

<h2 class="text-center">Users</h2>
<div>
    <form class="form-inline">
        <div class="form-group col-md-3">
            <label for="id">ID</label>
            <input name="id" class="form-control" id="id" placeholder="ID" value="<?= $id ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="email">Email</label>
            <input name="email" class="form-control" id="email" placeholder="Email" value="<?= $email ?>">
        </div>
        <div class="form-group col-md-4">
            <label for="username">Username</label>
            <input name="username" class="form-control" id="username" placeholder="Username" value="<?= $username ?>">
        </div>
        <button class="btn btn-default">Search</button>
    </form>
</div>
<div class="row" style="padding-top: 10px">
    <table class="table table-striped">
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-2">Username</th>
            <th class="col-md-2">Email</th>
            <th class="col-md-7">Operation</th>
        </tr>
        <?php
        foreach ($records as $record) {
            echo <<< USER
    <tr>
        <td>{$record->id}</td>
        <td>{$record->username}</td>
        <td>{$record->email}</td>
        <td>
            <a href="/user/submission/?user_id={$record->id}" target="_blank"><button type="button" class="btn btn-primary">Submissions</button></a>
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