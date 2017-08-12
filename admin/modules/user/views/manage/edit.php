<h2 class="text-center">Edit User</h2>
<input type="hidden" id="user_id" value="<?= $user->id ?>">
<form>
    <div class="form-group">
        <label for="id">Username</label>
        <input class="form-control" id="username" placeholder="Username" value="<?= $user->username ?>">
    </div>
    <div class="form-group">
        <label for="id">Email</label>
        <input class="form-control" id="email" placeholder="Email" type="email" value="<?= $user->email ?>">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" id="password" placeholder="Password" type="password">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" id="submit">Update</button>
    </div>
</form>
<div class="modal fade" id="error" tabindex="-1" role="dialog" style="padding-top: 15%">
    <div class="modal-dialog" role="document">
        <div id="error_message" class="alert alert-danger" role="alert"></div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#submit').on('click', function (event) {
            event.preventDefault();

            var user_id = $('#user_id').val(),
                username = $('#username').val(),
                email = $('#email').val(),
                password = $('#password').val(),
                error_message = $('#error_message'),
                error = $('#error');

            if (username.length === 0 || email.length === 0 || password.length === 0) {
                error_message.text("please fill all the blanks");
                error.modal();
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/user/manage/update',
                data: {
                    user_id: user_id,
                    username: username,
                    email: email,
                    password: password
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.reload();
                    } else {
                        error_message.text(res.message);
                        error.modal();
                    }
                },
                error: function () {
                    error_message.text("An error occurred, please try later.");
                    error.modal();
                }
            });
        });
    });
</script>