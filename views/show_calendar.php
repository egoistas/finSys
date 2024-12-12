<?php 


    $title = "Διαγωνισμός";
    $currentPage = "show_calendar.php";
    require ('../templates/header.php');

?>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        #calendar {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }

        .day {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .day:hover {
            background-color: #f0f0f0;
            cursor: pointer;
        }

        #event-details {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        
    </style>

<main>
    <!-- ΒΑΣΙΚΟ CONTAINER-->
    <div class="container shadow min-vh-100 py-2 my-2">
        <div class="row">
            <div class="col">
            <div id="calendar"></div>
            <div id="event-details"></div>
            <div>
</div>

            </div>           
        </div>

        <script>
    let currentYear;
    let currentMonth;

    function generateCalendar(year, month) {
        currentYear = year;
        currentMonth = month;
        const calendar = document.getElementById('calendar');
        const date = new Date(year, month);
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const firstDayIndex = date.getDay();
        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        calendar.innerHTML = `
            <div>
                <button onclick="previousMonth()">Previous</button>
                <h2>${monthNames[month]} ${year}</h2>
                <button onclick="nextMonth()">Next</button>
            </div>
            <div class="days">
                ${daysOfWeek.map(day => `<div class="day">${day}</div>`).join('')}
                ${generateDays(daysInMonth, firstDayIndex)}
            </div>
        `;
    }

    function generateDays(daysInMonth, firstDayIndex) {
        let days = '';

        for (let i = 0; i < firstDayIndex; i++) {
            days += `<div class="day"></div>`;
        }

        for (let i = 1; i <= daysInMonth; i++) {
            days += `<div class="day" onclick="getEventData(${i})">${i}</div>`;
        }

        return days;
    }

    function getEventData(day) {
        const date = `${currentYear}-${currentMonth + 1}-${day}`;

        fetch('../handlers/search_listofTasks.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=fetchDateFromCalendar&date=' + date,
        })
        .then(response => response.json())
        .then(data => {
            displayEventData(data);
        })
        .catch(error => {
            console.error('Error fetching event data:', error);
        });
    }

    function displayEventData(data) {
        const eventDetails = document.getElementById('event-details');
        eventDetails.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;
    }

    function previousMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentYear, currentMonth);
    }

    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentYear, currentMonth);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        generateCalendar(now.getFullYear(), now.getMonth());
    });
</script>

