<h2 class="text-center">Update Test Case <code># <?= $test_case->id ?></code></h2>
<input type="hidden" id="test_case_id" value="<?= $test_case->id ?>">
<div class="row">
    <div class="col-md-6">
        <label for="input">Input</label>
        <textarea class="form-control" rows="20" id="input"><?= $test_case->input ?></textarea>
    </div>
    <div class="col-md-6">
        <label for="output">Output</label>
        <textarea class="form-control" rows="20" id="output"><?= $test_case->output ?></textarea>
    </div>
</div>
<div class="row" style="padding-top: 10px;">
    <button class="btn btn-primary" id="submit">Update Test Case</button>
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
                error_message = $('#error_message'),
                error = $('#error');

            if (input.length === 0 || output.length === 0) {
                error_message.text("please fill all the blanks");
                error.modal();
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/problem/test-case/update',
                data: {
                    test_case_id: $('#test_case_id').val(),
                    input: input,
                    output: output
                },
                timeout: 3000,
                done: function (res) {
                    if (res.code === 0) {
                        location.reload();
                    } else {
                        error_message.text(res.message);
                        error.modal();
                    }
                },
                fail: function () {
                    error_message.text("An error occurred, please try later.");
                    error.modal();
                }
            });
        });
    });
</script>