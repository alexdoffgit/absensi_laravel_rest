<div class="bg-dark py-3">
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a href="#" class="d-block text-decoration-none text-white nav-link">
                <i class="bi bi-person-circle"></i>
                <span class="ms-1">{{ $empName }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a 
             href="{{ url('/logout') }}" 
             class="text-decoration-none text-white nav-link"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span class="ms-1">Log out</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/settings') }}" class="d-block text-decoration-none text-white nav-link">
                <i class="bi bi-gear-fill"></i>
                <span class="ms-1">Settings</span>
            </a>
        </li>
    </ul>
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>