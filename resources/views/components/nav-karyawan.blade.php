<div class="d-flex flex-column p-3 bg-dark justify-content-between" style="height: 100%;">
    <div class="d-flex flex-column">
        <a href="/" class="text-decoration-none text-danger fs-4 fw-bold">Wonokoyo</a>
        <ul class="nav flex-column mt-4">
            <li class="nav-item">
                <a href="{{ url("/{$uid}/kehadiran") }}" class="nav-link ps-0 link-light">Kehadiran</a>
            </li>
            <li class="nav-item">
                <div data-bs-toggle="collapse" aria-expanded="false" aria-controls="izinCollapse" data-bs-target="#izinCollapse" class="text-white py-2" style="cursor: pointer;">Izin</div>
                <div class="collapse" id="izinCollapse">
                    <a href="{{ url("/{$uid}/pengajuan-izin") }}" class="nav-link link-light">Pengajuan Izin</a>
                    <a href="{{ url("/{$uid}/permit-tracking") }}" class="nav-link link-light">Tracking Izin</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link ps-0 link-light">Jadwal</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link ps-0 link-light">Laporan</a>
            </li>
        </ul>
    </div>
</div>