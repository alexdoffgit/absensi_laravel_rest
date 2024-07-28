<x-layout title="Menu Access ID: {{ $menuId }}">
    <x-slot:viteslot>
        @vite('resources/sass/access-management/show.scss')
    </x-slot:viteslot>
    <div class="container">
        <div class="mx-auto" style="width: 80%;">
            <h1 class="mt-4">Menu Access for ID: {{ $menuId }}</h1>
            <table class="table table-striped absensi-access-management-show">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Menu Path</td>
                        <td>{{ $menu['menu_path'] }}</td>
                    </tr>
                    <tr>
                        <td>Menu Name</td>
                        <td>{{ $menu['menu_name'] }}</td>
                    </tr>
                    <tr>
                        <td>Laravel Controller Class</td>
                        <td>{{ $menu['laravel_controller_class'] }}</td>
                    </tr>
                    <tr>
                        <td>Laravel Controller Method</td>
                        <td>{{ $menu['laravel_controller_method'] }}</td>
                    </tr>
                    <tr>
                        <td>Laravel Middleware</td>
                        <td>{{ $menu['laravel_middleware'] }}</td>
                    </tr>
                    <tr>
                        <td>HTTP Method</td>
                        <td>{{ $menu['http_method'] }}</td>
                    </tr>
                    <tr>
                        <td>Route Type</td>
                        <td>{{ $menu['route_type'] }}</td>
                    </tr>
                    <tr>
                        <td>User ID</td>
                        <td>{{ $menu['user_id'] }}</td>
                    </tr>
                    <tr>
                        <td>Department ID</td>
                        <td>{{ $menu['dept_id'] }}</td>
                    </tr>
                    <tr>
                        <td>Department Level</td>
                        <td>{{ $menu['dlevel'] }}</td>
                    </tr>
                    <tr>
                        <td>Can All User Access?</td>
                        <td>{{ $menu['all_can_access'] ? 'yes': 'no' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-layout>