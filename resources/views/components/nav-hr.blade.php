<div class="d-flex flex-column p-3 bg-dark" style="height: 100vh">
    <a href="/" class="text-decoration-none text-danger fs-4 fw-bold">Wonokoyo</a>
    <hr class="text-white"/>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="#" class="nav-link ps-0 link-light">Karyawan</a>
        </li>
        <li class="nav-item">
            <div data-bs-toggle="collapse" aria-expanded="false" aria-controls="kehadiranCollapse" data-bs-target="#kehadiranCollapse" class="text-white py-2" style="cursor: pointer;">Kehadiran</div>
            <div class="collapse" id="kehadiranCollapse">
                <a href="{{ url("/{$uid}/kehadiran") }}" class="nav-link link-light">Kehadiran Pribadi</a>
                <a href="#" class="nav-link link-light">Kehadiran Karyawan</a>
            </div>
        </li>
        <li class="nav-item">
            <div data-bs-toggle="collapse" aria-expanded="false" aria-controls="izinCollapse" data-bs-target="#izinCollapse" class="text-white py-2" style="cursor: pointer;">Izin</div>
            <div class="collapse" id="izinCollapse">
                <a href="{{ url("/{$uid}/pengajuan-izin") }}" class="nav-link link-light">Pengajuan Izin</a>
                <a href="{{ url("/{$uid}/permit-tracking") }}" class="nav-link link-light">Tracking Izin</a>
                <a href="{{ url("{$uid}/hr/permit-summary") }}" class="nav-link link-light">Persetujuan Izin</a>
            </div>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link ps-0 link-light">Jadwal</a>
        </li>
        <li class="nav-item">
            <div data-bs-toggle="collapse" aria-expanded="false" aria-controls="laporanCollapse" data-bs-target="#laporanCollapse" class="text-white py-2" style="cursor: pointer;">Laporan</div>
            <div class="collapse" id="laporanCollapse">
                <a href="#" class="nav-link link-light">Kehadiran Sendiri</a>
                <a href="#" class="nav-link link-light">Kehadiran Karyawan</a>
            </div>
        </li>
    </ul>
</div>