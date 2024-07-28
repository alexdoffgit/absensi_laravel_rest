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
                                <a href="/access-management/{{ $menu['id'] }}">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="/access-management/{{ $menu['id'] }}/update">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="/access-management/{{ $menu['id'] }}" onclick="event.preventDefault(); document.getElementById('delete').submit();">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <form action="/access-management/{{ $menu['id'] }}" method="POST" style="display: none;" id="delete">
            @csrf
            @method('DELETE')
        </form>
    </div>
</x-layout>
