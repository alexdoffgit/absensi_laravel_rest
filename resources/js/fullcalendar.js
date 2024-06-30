import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import bootstrap5Plugin from '@fullcalendar/bootstrap5';

/**
 * 
 * @param {number} uid 
 * @returns {Calendar}
 */
function createCalendar(uid) {
  const calendarEl = document.getElementById("calendar");

  let calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin, bootstrap5Plugin],
    initialView: 'dayGridMonth',
    themeSystem: 'bootstrap5',
    headerToolbar: {
      start: 'title',
      right: false
    },
    events: {
      url: `/api/${uid}/kehadiran`
    }
  });

  return calendar
}


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
 * @param {{start: string, end: string}} timeRange
 * @returns {string} html string that will be inserted
 */
function calendarEventHTML(timeRange) {
  return `
    <div class="fc-daygrid-day-events">
      <div class="fc-daygrid-event-harness" style="margin-top: 0px;">
        <a class="fc-event fc-event-start fc-event-end fc-event-past fc-daygrid-event fc-daygrid-dot-event">
          <div class="fc-daygrid-event-dot" style="border-color: green;"></div>
          <div class="fc-event-title">${timeRange.start}</div>
        </a>
      </div>
    </div>
    <div class="fc-daygrid-day-events">
      <div class="fc-daygrid-event-harness" style="margin-top: 0px;">
        <a class="fc-event fc-event-start fc-event-end fc-event-past fc-daygrid-event fc-daygrid-dot-event">
          <div class="fc-daygrid-event-dot" style="border-color: green;"></div>
          <div class="fc-event-title">${timeRange.end}</div>
        </a>
      </div>
    </div>
  `;
}


export { createCalendar }