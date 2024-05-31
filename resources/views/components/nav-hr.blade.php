<style>
    .component-nav-body {
        height: 100vh;
        background-color: #291D1D;
    }
    .component-logo {
        color: #DE0808;
        font-weight: 900;
        padding-top: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #838383;
        text-align: center;
        font-size: 32px;
    }
    .component-nav-body > nav > ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .component-nav-body > nav > ul > li {
        padding-left: 1em;
        padding-top: .125em;
        padding-bottom: .125em;
        text-decoration: none;
    }
    .component-nav-body > nav > ul > li > a {
        text-decoration: none;
    }
    .component-izin-wrapper > .component-izin-toggle {
        color: white;
    }
    .component-izin-wrapper > .component-izin-submenu1 {
        padding-left: 12px;
    }
    .component-izin-wrapper > .component-izin-submenu1 a {
        text-decoration: none;
    }
</style>
<div class="component-nav-body">
    <div class="component-logo">
        Wonokoyo
    </div>
    <nav>
        <ul>
            <li>
                <a href="{{ url("{$karyawanId}/kehadiran") }}">Kehadiran</a>
            </li>
            <li>
                <div class="component-izin-wrapper">
                    <div class="component-izin-toggle">Izin</div>
                    <div class="component-izin-submenu1">
                        <div>
                            <a href="#" id="component-link-pengajuan-izin">Pengajuan Izin</a>
                        </div>
                        <div>
                            <a href="{{url("/{$karyawanId}/hr/daftar-izin")}}" id="component-link-persetujuan-izin">Persetujuan Izin</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a href="#">Jadwal</a>
            </li>
            <li>
                <a href="#">Laporan</a>
            </li>
        </ul>
    </nav>
</div>