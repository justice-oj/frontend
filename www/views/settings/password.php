<?php

use www\widgets\common\GoogleAdSenseWidget;

?>

<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget() ?>
</div>
<h2 class="ui header">Settings - Password</h2>
<div class="ui top fluid two item menu">
    <a class="item" href="/settings">Profile</a>
    <a class="item active">Password</a>
</div>
<div class="ui basic segment">
    <div class="ui big form">
        <div class="field">
            <label>Old Password</label>
            <input id="a" type="password">
        </div>
        <div class="field">
            <label>New Password</label>
            <input id="b" type="password">
        </div>
        <div class="field">
            <label>Retype New Password</label>
            <input id="c" type="password">
        </div>
        <div class="ui submit primary big button" id="update">Update</div>
    </div>
</div>
<div class="ui basic segment">
    <?= GoogleAdSenseWidget::widget() ?>
</div>
<script>
    $(document).ready(function () {
        $('.menu .item').tab();

        $('#update').on('click', function () {
            var a = $('#a').val(),
                b = $('#b').val(),
                c = $('#c').val();

            if (a.length === 0 || b.length === 0 || c.length === 0) {
                alert("Please fill in all the blanks");
                return;
            }

            if (b !== c) {
                alert("The two new passwords are not equal, please re-check again.");
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/settings/update-password',
                data: {
                    old_password: a,
                    new_password: b
                },
                timeout: 3000,
                done: function (res) {
                    if (res.code === 0) {
                        alert("OK");
                    } else {
                        alert("Failed: " + res.message);
                    }
                },
                fail: function () {
                    alert("An error occurred, please try again later.");
                }
            });
        });
    });
</script>