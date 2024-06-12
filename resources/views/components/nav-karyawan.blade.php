<div class="d-flex flex-column p-3 bg-dark" style="height: 100vh">
    <a href="/" class="text-decoration-none text-danger fs-4 fw-bold">Wonokoyo</a>
    <hr class="text-white"/>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ url("/{$uid}/kehadiran") }}" class="nav-link ps-0">Kehadiran</a>
        </li>
        <li class="nav-item">
            <div data-bs-toggle="collapse" aria-expanded="false" aria-controls="izinCollapse" data-bs-target="#izinCollapse" class="text-white py-2" style="cursor: pointer;">Izin</div>
            <div class="collapse" id="izinCollapse">
                <a href="{{ url("/{$uid}/pengajuan-izin") }}" class="nav-link">Pengajuan Izin</a>
                <a href="{{ url("/{$uid}/permit-tracking") }}" class="nav-link">Tracking Izin</a>
            </div>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link ps-0">Jadwal</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link ps-0">Laporan</a>
        </li>
    </ul>
</div>