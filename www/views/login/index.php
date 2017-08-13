<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui teal image header">
            <img src="/images/logo/justice-black.png" class="image">
        </h2>
        <form class="ui large form">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input id="email" placeholder="E-mail address">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" id="password" placeholder="Password">
                    </div>
                </div>
                <div class="ui fluid large teal submit button" id="auth">Login</div>
            </div>
        </form>
        <div class="ui orange message">
            Try with<div class="ui tiny label">i@liuchao.me / demo</div>if you don't have an account.
        </div>
    </div>
</div>
<div class="ui small modal">
    <div class="header">Error</div>
    <div class="content">
        <p id="modal_content"></p>
    </div>
    <div class="actions">
        <div class="ui red cancel button">
            OK
        </div>
    </div>
</div>