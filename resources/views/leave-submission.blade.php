<x-layout title="Leave Submission">
    <div class="leave-submission-container mt-3">
        <h1>Pengajuan Izin</h1>
        <form action="/{{$karyawanId}}/pengajuan-izin" method="POST" enctype="multipart/form-data">
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
                        <option value="{{ $perAtasan->USERID }}">{{ $perAtasan->fullname }}</option>
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
            <div class="mb-3 mt-3">
                <label for="dokumen" class="form-label">Dokumen Pendukung</label>
                <input type="file" class="form-control" id="dokumen" name="dokumen">
            </div>
            <button type="submit" class="btn btn-primary">Ajukan Izin</button>
        </form>
    </div>
</x-layout>