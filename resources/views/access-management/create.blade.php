<x-layout title="Access Management | Create">
    <div class="container">
        <div class="mx-auto" style="width: 50%;">
            <h1>Create New Menu</h1>
            <form action="/access-management/new" method="POST" class="border rounded">
                @csrf
                <div class="mt-3 mb-3 mx-3">
                    <label for="menu-path" class="form-label">Menu Path</label>
                    <input type="text" name="menu-path" id="menu-path" class="form-control" required>
                </div>
                <div class="mt-3 mb-3 mx-3">
                    <label for="menu-name" class="form-label">Menu Name</label>
                    <input type="text" name="menu-name" id="menu-name" class="form-control">
                </div>
                <div class="mb-3 mx-3">
                    <label for="laravel-controller-class" class="form-label">Laravel Controller Class</label>
                    <input type="text" name="laravel-controller-class" id="laravel-controller-class" class="form-control" required>
                </div>
                <div class="mb-3 mx-3">
                    <label for="laravel-controller-method" class="form-label">Laravel Controller Method</label>
                    <input type="text" name="laravel-controller-method" id="laravel-controller-method" class="form-control" required>
                </div>
                <div class="mb-3 mx-3">
                    <label for="laravel-middleware" class="form-label">Laravel Middleware</label>
                    <input type="text" name="laravel-middleware" id="laravel-middleware" class="form-control" required>
                </div>
                <div class="mb-3 mx-3">
                    <label for="http-method" class="form-label">HTTP Method</label>
                    <select name="http-method" id="http-method" class="form-select">
                        <option value="get">GET</option>
                        <option value="post">POST</option>
                        <option value="put">PUT</option>
                        <option value="delete">DELETE</option>
                    </select>
                </div>
                <div class="mb-3 mx-3">
                    <label class="form-label">Route Type</label>
                    <div class="form-check">
                        <input type="radio" name="route-type" id="route-type-web" value="web" class="form-check-input" checked>
                        <label for="route-type-web" class="form-check-label">Web</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="route-type" id="route-type-api" value="api" class="form-check-input">
                        <label for="route-type-api" class="form-check-label">API</label>
                    </div>
                </div>
                <div class="mb-3 mx-3">
                    <label for="user" class="form-label">User That Can Access</label>
                    <select name="user" id="user" class="form-select">
                        <option value="0" selected></option>
                        @foreach ($users as $user)
                            <option value="{{ $user['id'] }}">{{ $user['fullname'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 mx-3">
                    <label for="department" class="form-label">Departments</label>
                    <select name="department" id="department" class="form-select">
                        <option value="0" selected></option>
                        @foreach ($departments as $department)
                            <option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 mx-3">
                    <label for="dlevel" class="form-label">Department Level</label>
                    <select name="dlevel" id="dlevel" class="form-select">
                        <option value="0" selected></option>
                        <option value="1.0">1</option>
                        <option value="2.0">2</option>
                        <option value="3.0">3</option>
                        <option value="4.0">4</option>
                    </select>
                </div>
                <div class="mb-3 mx-3">
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" role="switch" id="all-can-access" name="all-can-access">
                        <label for="all-can-access" class="form-check-label">All User Can Access?</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ms-3 mb-3">
                    Create Menu
                </button>
            </form>
        </div>
    </div>
</x-layout>