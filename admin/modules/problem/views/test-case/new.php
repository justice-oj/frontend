<h2 class="text-center">Add Test Case</h2>
<input type="hidden" id="problem_id" value="<?= $problem_id ?>">
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <label for="input">Input</label>
            <textarea class="form-control" rows="20" id="input"></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <label for="output">Output</label>
        <textarea class="form-control" rows="20" id="output"></textarea>
    </div>
</div>
<div class="row" style="padding-top: 10px;">
    <button class="btn btn-primary" id="submit">Add Test Case</button>
</div>
<div class="modal fade" id="error" tabindex="-1" role="dialog" style="padding-top: 15%">
    <div class="modal-dialog modal-sm" role="document">
        <div id="error_message" class="alert alert-danger" role="alert"></div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#submit').on('click', function (event) {
            event.preventDefault();

            var input = $('#input').val(),
                output = $('#output').val(),
                problem_id = $('#problem_id').val(),
                error_message = $('#error_message'),
                error = $('#error');

            if (input.length === 0 || output.length === 0) {
                error_message.text("please fill all the blanks");
                error.modal();
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/problem/test-case/add',
                data: {
                    problem_id: problem_id,
                    input: input,
                    output: output
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.href = '/problem/test-case?problem_id=' + problem_id
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