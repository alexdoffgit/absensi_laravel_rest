import $ from 'jquery';

const todayDate = () => {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
    const day = ('0' + currentDate.getDate()).slice(-2);
    const formattedDate = year + '-' + month + '-' + day;

    return formattedDate;
};

$("#tanggal_pengajuan").val(todayDate());