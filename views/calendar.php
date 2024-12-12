<!--ΗΜΕΡΟΛΟΓΙΟ-->
<div id="calendar" class="text-center fs-6 font-monospace "></div>
    <div id="event-details" class="alert alert-dismissible alert-success fw-semibold"></div>

    <script>
        function generateCalendar(year, month) {
            const calendar = document.getElementById('calendar');
            const date = new Date(year, month);
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const firstDayIndex = date.getDay();
            const daysOfWeek = ['Κυρ', 'Δευ', 'Τρι', 'Τετ', 'Πεμ', 'Παρ', 'Σαβ'];

            const monthNames = ['Ιανουάριος', 'Φεβρουάριος', 'Μάρτιος', 'Απρίλιος', 'Μάιος', 
            'Ιούνιος', 'Ιούλιος', 'Αύγουστος', 'Σεπτέμβριος', 'Οκτώβριος', 'Νοέμβριος', 'Δεκέμβριος'];

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
        //Επιστρέφει τα δεδομένα της ημερομηνίας
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
     
   
        //Εμφανίζει τα γεγονότα
        function displayEventData(data) {
            const eventDetails = document.getElementById('event-details');
            // Έλεγχος εάν τα δεδομένα δεν είναι κενά
            if (data.length > 0) {
            // Δημιουργία HTML για την εμφάνιση των γεγονότων
            let html = '<ul>';
            data.forEach((event, index) => {
                html += `<li>${index + 1}. ${event}</li><br>`;
            });
            html += '</ul>';
            // Εμφάνιση του HTML στο element event-details
            eventDetails.innerHTML = html;
            } else {
            // Εάν δεν βρέθηκαν γεγονότα, εμφανίζεται ένα μήνυμα
            eventDetails.innerHTML = '<p>Δεν βρέθηκαν γεγονότα για την επιλεγμένη ημερομηνία.</p>';
            }
        }

        // Καλεί την generateCalendar με την τρέχουσα ημερομηνία
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            generateCalendar(now.getFullYear(), now.getMonth());
        });
    </script>
     <!--ΗΜΕΡΟΛΟΓΙΟ-->
