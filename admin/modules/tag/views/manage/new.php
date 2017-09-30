<h2 class="text-center">Add Tag</h2>
<form>
    <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" id="name" placeholder="Tag Name">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" id="submit">Add</button>
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

            var name = $('#name').val(),
                error_message = $('#error_message'),
                error = $('#error');

            if (name.length === 0) {
                error_message.text("please fill all the blanks");
                error.modal();
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/tag/manage/add',
                data: {
                    name: name
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.href = "/tag";
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