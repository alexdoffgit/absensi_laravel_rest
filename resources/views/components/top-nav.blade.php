<div class="bg-dark py-3 d-flex justify-content-between align-items-center">
    <span>
        <a 
         href="/" 
         style="text-decoration: none" 
         class="text-danger mx-4 fw-bold fs-5">
            wonokoyo
        </a>
    </span>
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