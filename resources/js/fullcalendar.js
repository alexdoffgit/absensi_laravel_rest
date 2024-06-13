import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import bootstrap5Plugin from '@fullcalendar/bootstrap5';


function createCalendar(uid) {
  const calendarEl = document.getElementById("calendar");
  
  const calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin, bootstrap5Plugin],
    initialView: 'dayGridMonth',
    themeSystem: 'bootstrap5',
    events: `/api/${uid}/2023-12-12/kehadiran`
  });

  return calendar
}

export { createCalendar }