<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    #simple-container {
        height: 100vh;
        display: grid;
        place-items: center;
    }
</style>
<body>
    @if (session('invalid'))    
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Invalid Credentials
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div id="simple-container">
        <div class="border border-solid w-1/2 pb-8">
            <h1 class="text-lg font-bold text-center m-6 mt-6">Login</h1>
            <form action="/login" method="POST" class="flex flex-col gap-6">
                @csrf
                <div class="flex flex-col mx-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="border border-solid p-1 px-2 rounded-sm" required>
                </div>
                <div class="flex flex-col mx-2">
                    <label for="passwd" class="form-label">Password</label>
                    <div class="border border-solid rounded-sm flex">
                        <input type="password" name="passwd" id="passwd" class="flex-grow" required>
                        <span class="m-1" id="toggle-password">
                            <i class="bi bi-eye-fill" id="password-icon"></i>
                        </span>
                    </div>
                </div>
                <button class="p-1 bg-blue-500 text-white mb-3 mx-2 rounded-sm">Login</button>
            </form>
        </div>
    </div>
</body>
</html>