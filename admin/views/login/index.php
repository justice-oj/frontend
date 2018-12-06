<div class="login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content">
                            <div class="logo">
                                <h1>Justice Plus Admin</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <form method="get" class="form-validate">
                                <div class="form-group">
                                    <input id="username" type="text" name="username" required
                                           data-msg="Please enter your username" class="input-material">
                                    <label for="username" class="label-material">Username</label>
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" name="password" required
                                           data-msg="Please enter your password" class="input-material">
                                    <label for="password" class="label-material">Password</label>
                                </div>
                                <button id="auth" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights text-center">
        <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
    </div>
</div>

<div class="modal fade" id="error" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="error_message"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var materialInputs = $('input.input-material');
        materialInputs.filter(function () {
            return $(this).val() !== "";
        }).siblings('.label-material').addClass('active');
        materialInputs.on('focus', function () {
            $(this).siblings('.label-material').addClass('active');
        });
        materialInputs.on('blur', function () {
            $(this).siblings('.label-material').removeClass('active');

            if ($(this).val() !== '') {
                $(this).siblings('.label-material').addClass('active');
            } else {
                $(this).siblings('.label-material').removeClass('active');
            }
        });


        $('#auth').on('click', function (event) {
            event.preventDefault();
            var username = $('#username'), password = $('#password');
            $.ajax({
                type: 'POST',
                url: '/login/auth',
                data: {
                    username: username.val(),
                    password: password.val()
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.href = '/';
                    } else {
                        $('#error_message').text(res.message);
                        $('#error').modal();
                    }
                },
                error: function () {
                    $('#error_message').text('an error occurred, lease login later');
                    $('#error').modal();
                }
            });
        });
    });
</script>