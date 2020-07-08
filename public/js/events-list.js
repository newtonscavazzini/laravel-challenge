// Load DOM Elements
let dayNode = document.querySelector('.day-card').cloneNode(true);
document.querySelector('.day-card').remove();
let eventNode = document.querySelector('.event-card').cloneNode(true);
document.querySelector('.event-card').remove();

let loading = document.querySelector('#loading');
let header_month = document.querySelector('#header-month');
let header_year = document.querySelector('#header-year');
let current_month = document.querySelector('#current-month');
let btn_previous_month = document.querySelector('#btn-previous-month');
let btn_next_month = document.querySelector('#btn-next-month');
let select_year = document.querySelector('#select_year');
let select_month = document.querySelector('#select_month');

// Define functions
function createEventElement(id, title) {
    let event = eventNode.cloneNode(true);
    event.href = eventUrl(id);
    event.innerText = title;

    return event;
}
function createDayElement(title, events) {
    let day = dayNode.cloneNode(true);
    day.querySelector('.day-card-title').innerText = title;

    if (events.length === 0) {
        day.querySelector('.day-card-subtitle').innerText = 'No events for this day';
    } else if (events.length === 1) {
        day.querySelector('.day-card-subtitle').innerText = events.length + ' event for this day';
    } else {
        day.querySelector('.day-card-subtitle').innerText = events.length + ' event(s) for this day';
    }

    if (events.length > 0) {
        for (i = 0; i < events.length; i++) {
            day.querySelector('.day-card-events-ul').appendChild(events[i]);
        }
    } else {
        day.querySelector('.day-card-events').remove();
    }

    return day;
}
function renderCalendar(json) {

    let response = JSON.parse(json);

    if (response.month) {
        current_month.textContent = response.month.substr(0, 3) + ' ' + response.year;
        header_month.textContent = response.month;
        select_month.querySelector('[value="' + response.month_numerical + '"]').selected = true;
    }
    if (response.year) {
        header_year.textContent = response.year;
        select_year.querySelector('[value="' + response.year + '"]').selected = true;
    }

    if (response.links.previousMonth) {
        btn_previous_month.querySelector('#txt-previous-month').innerHTML = response.links.previousMonth.month.substr(0, 3) +
            ' ' + response.links.previousMonth.year;
        btn_previous_month.setAttribute('data-month', response.links.previousMonth.month_numerical);
        btn_previous_month.setAttribute('data-year', response.links.previousMonth.year);
    }
    if (response.links.nextMonth) {
        btn_next_month.querySelector('#txt-next-month').innerHTML = response.links.nextMonth.month.substr(0, 3) +
            ' ' + response.links.nextMonth.year;
        btn_next_month.setAttribute('data-month', response.links.nextMonth.month_numerical);
        btn_next_month.setAttribute('data-year', response.links.nextMonth.year);
    }

    if (response.calendar) {
        for (let day in response.calendar) {
            let events = [];

            for (let event = 0; event < response.calendar[day]['events'].length; event++) {
                let e = response.calendar[day]['events'][event];
                events.push(createEventElement(e.id, e.title));
            }

            loading.hidden = true;
            document.querySelector('#events_list').appendChild(createDayElement(response.calendar[day].date, events));
        }
    }
}
function loadMonth(month, year) {

    document.querySelector('#events_list').innerHTML = '';
    loading.hidden = false;

    let xhr = new XMLHttpRequest();
    xhr.open("GET", apiUrl(month, year),true);

    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                renderCalendar(this.responseText);
        }
    }
    xhr.send();

}
function apiUrl(month, year) {
    return '/calendar/' + month + '/' + year;
}
function eventUrl(id) {
    return '/events/' + id;
}

// Add navigation events
[btn_previous_month, btn_next_month].forEach(function(btn) {
    btn.addEventListener('click', function() {
        let m = this.getAttribute('data-month');
        let y = this.getAttribute('data-year');
        loadMonth(m, y);
    }, false);
});
document.querySelector('#btn-specific-month').addEventListener('click', function() {
    let m = select_month.value;
    let y = select_year.value;
    loadMonth(m, y);
}, false);
