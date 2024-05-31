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
</style>
<body>
    <div class="simple-container">
        <div class="formbox">
            <h1>Login</h1>
            <form action="/login" method="POST">
                @csrf
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control">
                <label for="passwd" class="form-label">Password</label>
                <input type="password" name="passwd" id="passwd" class="form-control">
                <button class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</body>
</html>