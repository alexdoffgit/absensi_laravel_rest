import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import bootstrap5Plugin from '@fullcalendar/bootstrap5';

/**
 * 
 * @param {string} isoDate a date that determined the year and month in ISO8601 string
 * @return {{start: string, end: string}} start and ending date in ISO8601 string
 */
function getFirstAndLastDayOfMonth(isoDate) {
  const date = new Date(isoDate);
  const year = date.getFullYear();
  const month = date.getMonth();

  // First day of the month
  const firstDay = new Date(year, month, 1);

  // Last day of the month
  const lastDay = new Date(year, month + 1, 0);

  return {
      start: firstDay.toISOString(),
      end: lastDay.toISOString()
  };
}

/**
 * 
 * @param {number} uid 
 * @returns {Calendar}
 */
function createCalendar(uid) {
  const calendarEl = document.getElementById("calendar");
  
  const timeRange = getFirstAndLastDayOfMonth((new Date('2023-12-15')).toISOString());

  const calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin, bootstrap5Plugin],
    initialView: 'dayGridMonth',
    themeSystem: 'bootstrap5',
    headerToolbar: {
      start: 'title',
      right: false
    },
    events: function (info, successCallback, failureCallBack) {
      fetch(`/api/${uid}/kehadiran?start=${timeRange.start}&end=${timeRange.end}`)
        .then(res => {
          if(!res.ok) {
            throw new Error('status + ' + res.status);
          }
          return res.json();
        })
        .then(data => {
          successCallback(data);
        })
        .catch(err => failureCallBack(err))
    }
  });

  return calendar
}

export { createCalendar }