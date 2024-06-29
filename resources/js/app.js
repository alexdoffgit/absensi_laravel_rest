import './lbootstrap';
import $ from 'jquery';
import 'bootstrap';
import '@popperjs/core';
import "bootstrap-icons/font/bootstrap-icons.css";
import { createCalendar } from './fullcalendar'

window.$ = $;
window.absensi = {
    createCalendar,
    writtenDate: new Date()
}