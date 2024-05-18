<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengajuan Izin</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .simple-container {
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 1rem;
            padding: 2rem;
        }
    </style>
</head>
<body>
    <div class="simple-container border border-dark rounded">
        <h1>Pengajuan Izin</h1>
        <form action="/{{$karyawanId}}" method="POST">
            @csrf
            <div class="mb-3 mt-3">
                <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
                <input type="text" readonly class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan">
            </div>
            <div class="row mb-3 mt-3">
                <div class="col-6">
                    <label for="mulai_izin" class="form-label">Tanggal Mulai Izin</label>
                    <input type="date" class="form-control" id="mulai_izin" name="mulai_izin">
                </div>
                <div class="col-6">
                    <label for="selesai_izin" class="form-label">Tanggal Selesai Izin</label>
                    <input type="date" class="form-control" id="selesai_izin" name="selesai_izin">
                </div>
            </div>
            <div class="mb-3 mt-3">
                <label for="atasan" class="form-label">Nama Atasan</label>
                <select name="atasan" id="atasan" class="d-block form-select">
                    @foreach ($semuaAtasan as $perAtasan)
                        <option value="{{ $perAtasan->USERID }}">{{ $perAtasan->Name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="izin" class="form-label">Tipe Izin</label>
                <select name="izin" id="izin" class="d-block form-select">
                    @foreach ($semuaIzin as $tipeIzin)
                        <option value="{{ $tipeIzin->LEAVEID }}">{{ $tipeIzin->LEAVENAME }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="alasan" class="form-label">Alasan</label>
                <textarea name="alasan" id="alasan" cols="30" rows="5" class="d-block form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajukan Izin</button>
        </form>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
<script type="module">
    $(document).ready(function() {
        const todayDate = () => {
            const currentDate = new Date();
            const year = currentDate.getFullYear();
            const month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
            const day = ('0' + currentDate.getDate()).slice(-2);
            const formattedDate = year + '-' + month + '-' + day;

            return formattedDate;
        };

        $("#tanggal_pengajuan").val(todayDate());
    })
</script>
</html>