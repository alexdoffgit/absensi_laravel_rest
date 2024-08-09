<x-layout title="Leave Submission">
    <div class="leave-submission-container mt-3">
        <h1>Pengajuan Izin</h1>
        <form action="/leave-submission" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3">
                <label for="request_date" class="form-label">{{ __('leave-submission.request-date') }}</label>
                <input type="text" readonly class="form-control" id="request_date" name="request_date">
            </div>
            <div class="mb-3 mt-3">
                <label for="daterange" class="form-label">Tanggal Izin</label>
                <input type="text" class="form-control" id="daterange" name="leave_period">
            </div>
            <div class="mb-3 mt-3">
                <label for="manager" class="form-label">Nama Atasan</label>
                <select name="atasan_id" id="manager" class="d-block form-select">
                    @foreach ($semuaAtasan as $perAtasan)
                        <option value="{{ $perAtasan->USERID }}">{{ $perAtasan->fullname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="leave" class="form-label">Tipe Izin</label>
                <select name="leave" id="leave_id" class="d-block form-select">
                    @foreach ($semuaIzin as $tipeIzin)
                        <option value="{{ $tipeIzin->LEAVEID }}">{{ $tipeIzin->LEAVENAME }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="reason" class="form-label">Alasan</label>
                <textarea name="reason" id="reason" cols="30" rows="5" class="d-block form-control"></textarea>
            </div>
            <div class="mb-3 mt-3">
                <label for="document" class="form-label">Dokumen Pendukung</label>
                <input type="file" class="form-control" id="document" name="document">
            </div>
            <button type="submit" class="btn btn-primary">Ajukan Izin</button>
        </form>
    </div>
</x-layout>