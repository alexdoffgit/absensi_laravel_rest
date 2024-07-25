<x-layout title="Access Management">
    <div class="container">
        <div class="mx-auto" style="width: 80%;">
            <h1 class="mt-4">Menu Access Table</h1>
            <a href="/access-management/new" class="btn btn-primary float-end">Create Menu</a>
            <table class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Menu Name</th>
                        <th>Menu Path</th>
                        <th>...</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                        <tr>
                            <td>{{ $menu['menu_name'] }}</td>
                            <td>{{ $menu['menu_path'] }}</td>
                            <td>
                                <i class="bi bi-pencil-square"></i>
                                <i class="bi bi-trash-fill"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
