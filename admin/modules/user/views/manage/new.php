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
            <li class="active">
                <a href="/user"> <i class="fa fa-user-circle"></i>User</a>
            </li>
            <li>
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
                <h2 class="h5 no-margin-bottom">Add User</h2>
            </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
            <div class="col-lg-12">
                <div class="block-body">
                    <form>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input required id="username" type="text" placeholder="Username"
                                   class="mr-sm-2 form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input required id="email" type="email" placeholder="Email" class="mr-sm-2 form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input required id="password" type="password" placeholder="Password"
                                   class="mr-sm-2 form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" id="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="error_message">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
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
        $('#submit').on('click', function (event) {
            event.preventDefault();

            var username = $('#username').val(),
                email = $('#email').val(),
                password = $('#password').val(),
                error_message = $('#error_message'),
                error = $('#error');

            if (username.length === 0 || email.length === 0 || password.length === 0) {
                error_message.text("Please fill all the blanks");
                error.modal();
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/user/manage/add',
                data: {
                    username: username,
                    email: email,
                    password: password
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.href = "/user";
                    } else {
                        error_message.text(res.message);
                        error.modal();
                    }
                },
                error: function () {
                    error_message.text("An error occurred, please try later");
                    error.modal();
                }
            });
        });
    });
</script>