<style>
    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-top: 10px;
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .account-wall {
        margin-top: 20px;
        padding: 40px 0 20px 0;
        background-color: #f7f7f7;
        border-radius: 10px;
        -moz-box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
    }
    .login-title {
        color: #555;
        font-size: 18px;
        font-weight: 400;
        display: block;
    }
</style>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1 class="text-center login-title">Sign in</h1>
        <div class="account-wall">
            <div class="text-center">
                <i class="fa fa-user-secret fa-5x"></i>
            </div>
            <form class="form-signin">
                <input class="form-control" placeholder="Username" id="username" required autofocus>
                <input type="password" class="form-control" placeholder="Password" id="password" required>
                <button class="btn btn-lg btn-primary btn-block">Sign in</button>
            </form>
        </div>
    </div>
</div>