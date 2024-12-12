<?php 

    $title = "Αρχική";
    $currentPage = "home.php";
    require ('../templates/header.php');

?>
    <!-- ΒΑΣΙΚΟ CONTAINER-->
    <div id = db_table_wrapper class="container shadow min-vh-100 py-2">
        <div class="row">
            <div class="col">
                <!-- data table Α -->
                <table id="db_table" class="table table-sm table-striped" style="width: 100%; max-width: 100%;">
                <style>
        body {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            background-color: #f0f0f0;
        } */

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
    <script src="../public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <form >
    <div id="calendar"></div>
    <div id="event-details"></div>
    </form>
    <script>
        function generateCalendar(year, month) {
            const calendar = document.getElementById('calendar');
            const date = new Date(year, month);
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const firstDayIndex = date.getDay();
            const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            calendar.innerHTML = `
                <h2>${monthNames[month]} ${year}</h2>
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
            const year = new Date().getFullYear();
            const month = new Date().getMonth() + 1;
            const date = `${year}-${month}-${day}`;

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
            // Display the fetched data in the event-details div
            // You can customize this as per your requirement
            eventDetails.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            generateCalendar(now.getFullYear(), now.getMonth());
        });
    </script>

                   
                </table>
                <!-- data table Ω -->
            </div>           
        </div>
        <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php $x=76; echo $x."%";?>;">
                        <?php $x."%"?>
                    </div>
                </div>
    </div>        
    <!-- ΒΑΣΙΚΟ CONTAINER-->
    <!-- <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php $x=76; echo $x."%";?>;">
                        <?php $x."%"?>
                    </div>
                </div> -->


    <?php
    include "../templates/footer.php"; // Include the footer
    ?>
</body>

</html>
