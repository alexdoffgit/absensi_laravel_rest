import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import bootstrap5Plugin from '@fullcalendar/bootstrap5';

const calendarEl = document.getElementById("calendar");

const calendar = new Calendar(calendarEl, {
  plugins: [dayGridPlugin, bootstrap5Plugin],
  initialView: 'dayGridMonth',
  themeSystem: 'bootstrap5',
  events: [
    {
        start: '2024-06-12',
        end: '2024-06-14',
        title: 'tes',
        backgroundColor: 'green',
        display: 'background'
    }
  ]
});

calendar.render()