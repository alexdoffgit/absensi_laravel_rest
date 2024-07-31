<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\LeaveSubmission;
use App\Rules\LeaveSubmission\DateRangeRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LeaveSubmissionController extends Controller
{
    public function __construct(private LeaveSubmission $leaveSubmissionStore) { }

    public function create(Request $request) {
        $karyawanid = Auth::user()->USERID;

        return view('leave-submission', [
            'karyawanId' => $karyawanid,
            'semuaIzin' => $this->leaveSubmissionStore->tipeIzin(),
            'semuaAtasan' => $this->leaveSubmissionStore->getAtasanByKaryawanId($karyawanid)
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'request_date' => 'required|date_format:Y-m-d',
            'daterange' => [new DateRangeRule],
            'manager_id' => 'numeric',
            'leave_id' => 'numeric',
            'reason' => 'nullable',
            'document' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        if($request->hasFile('document')) {
            $filePath = $request->file('document')->store('uploads', 'public');
            $data['document_path'] = $filePath;
            $this->storeLeaveSubmissionWithFile($data);
        } else {
            $this->storeLeaveSubmission($data);
        }

        return redirect('/leave-submission');
    }

    private function storeLeaveSubmissionWithFile($validatedRequestData)
    {
        $uid = Auth::user()->USERID;
        $dateRange = $this->getDateRangeFromString($validatedRequestData['daterange']);
        $formData = [
            'user_id' => $uid,
            'reason' => $validatedRequestData['reason'],
            'leaveclass_id' => $validatedRequestData['leave_id'],
            'submission_date' => $validatedRequestData['request_date'],
            'date_start' => $dateRange['start'],
            'date_end' => $dateRange['end'],
            'supporting_document' => $validatedRequestData['document_path'] 
        ];
        $this->leaveSubmissionStore->create($formData);
    }

    private function storeLeaveSubmission($validatedRequestData)
    {
        $uid = Auth::user()->USERID;
        $dateRange = $this->getDateRangeFromString($validatedRequestData['daterange']);
        $formData = [
            'user_id' => $uid,
            'reason' => $validatedRequestData['reason'],
            'leaveclass_id' => $validatedRequestData['leave_id'],
            'submission_date' => $validatedRequestData['request_date'],
            'date_start' => $dateRange['start'],
            'date_end' => $dateRange['end'],
        ];
        $this->leaveSubmissionStore->create($formData);
    }

    /**
     * @param mixed $value
     * @return array{
     *   'start': \DateTimeInterface,
     *   'end': \DateTimeInterface
     * }
     */
    private function getDateRangeFromString($dateRangeString) 
    {
        $dateRange = explode(" - ", $dateRangeString);
        $dateStart = \DateTimeImmutable::createFromFormat('Y-m-d', $dateRange[0]);
        $dateEnd = \DateTimeImmutable::createFromFormat('Y-m-d', $dateRange[1]);
        return [
            'start' => $dateStart,
            'end' => $dateEnd
        ];
    }

    public function createApi(Request $request, string $karyawanname) {
        $tanggalPengajuan = $request->input("tanggal_pengajuan");
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
        $atasanId = intval($request->input('atasan_id'));
        $tipeIzin = intval($request->input('tipe_izin'));
        $alasan = $request->input('alasan');

        $karyawan = DB::table('userinfo')->select('USERID')->where('Name', '=', $karyawanname)->first();

        $internalData = [
            'tanggal_pengajuan' => $tanggalPengajuan,
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'atasan_id' => $atasanId,
            'tipe_izin' => $tipeIzin,
            'alasan' => $alasan
        ];

        $isSuccess = $this->leaveSubmissionStore->create($karyawan->USERID, $internalData);
    }

    public function persetujuanIzin(Request $request, string $atasanid, string $listizinid)
    {
        $status = intval($request->input('accrej'));
        $this->leaveSubmissionStore->persetujuanIzin($status, intval($atasanid), intval($listizinid));
    }
}
