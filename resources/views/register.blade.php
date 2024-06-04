<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    .simple-container {
        display: grid;
        place-items: center;
        height: 100vh;
    }
    .formbox {
        width: 45%;
        padding: 2em;
        padding-top: 1em;
        border: 1px solid lightgray;
        border-radius: 20px;
    }
    .formbox > h1 {
        text-align: center;
    }
    .formbox > form label {
        margin-top: 2em;
    }
    .formbox > form button {
        margin-top: 2em;
    }
    #toggle-password {
        cursor: pointer;
    }
</style>
<body>
    <div class="simple-container">
        <div class="formbox">
            <h1>Register</h1>
            <form action="/register" method="POST" class="row">
                @csrf
                <div class="col-12">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="col-12">
                    <label for="passwd" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="passwd" id="passwd" class="form-control" required>
                        <span class="input-group-text" id="toggle-password">
                            <i class="bi bi-eye-fill" id="password-icon"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary col-2">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script type="module">
    $(function() {
        const passwordShowIcon = "bi bi-eye-fill";
        const passwordHideIcon = "bi bi-eye-slash-fill";
        let showPassword = false;

        $("#toggle-password").click(function() {
            showPassword = !showPassword;
            
            if(showPassword) {
                $("#password-icon").removeClass(passwordShowIcon);
                $("#password-icon").addClass(passwordHideIcon);
                $("#passwd").attr("type", "text");
            } else {
                $("#password-icon").removeClass(passwordHideIcon);
                $("#password-icon").addClass(passwordShowIcon);
                $("#passwd").attr("type", "password");
            }
        })

    });
</script>
</html>