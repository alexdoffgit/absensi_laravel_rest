import $ from 'jquery';
import Litepicker from 'litepicker';

const todayDate = () => {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
    const day = ('0' + currentDate.getDate()).slice(-2);
    const formattedDate = year + '-' + month + '-' + day;

    return formattedDate;
};

let tanggalPengajuanEl = $("#tanggal_pengajuan");

if (tanggalPengajuanEl) {
    tanggalPengajuanEl.val(todayDate())
}

let dateRangeEl = document.getElementById("daterange")

if (dateRangeEl) {
    new Litepicker({
        element: dateRangeEl,
        singleMode: false,
        lockDays: [['1998-07-01', '2023-01-01']]
    })
}
