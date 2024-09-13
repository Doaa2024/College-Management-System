<?php require_once('common/header.php'); ?>
<?php
require_once("class/calender.class.php");
$calender = new Calender();
$allCalendar = $calender->getCalender();
// Convert to the format required by JavaScript
$eventsByMonth = [];

foreach ($allCalendar as $event) {
    $eventDate = new DateTime($event["EventDate"]);
    $monthYear = $eventDate->format('Y-m');

    if (!isset($eventsByMonth[$monthYear])) {
        $eventsByMonth[$monthYear] = [];
    }

    $eventsByMonth[$monthYear][] = [
        'date' => $eventDate->format('d/M'),
        'title' => $event["EventName"],
        'location' => $event["BranchName"],
        'time' => $event["StartTime"]
        // Assuming StartTime is used as location for demonstration
    ];
}

// Output as JSON
echo '<script>';
echo 'const allCalendar = ' . json_encode($eventsByMonth) . ';';
echo '</script>';


?>
<style>
    /* Base styles (for larger screens) */
    .calendar-section {
        padding: 40px 0;
        text-align: center;
    }

    .calendar-container {
        display: flex;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .calendar-box,
    .event-box {
        flex: 1;
        margin: 0 3px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .calendar-header,
    .event-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .calendar-nav,
    .event-nav {
        background-color: #f1c152;
        border: none;
        color: #fff;
        padding: 8px;
        border-radius: 40px;
        font-size: 30px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .calendar-nav:hover,
    .event-nav:hover {
        background-color: #d1a74f;
    }

    .calendar-month-year,
    .event-title {
        font-size: 24px;
        color: #555;
        margin: 0;
    }

    .event-title {
        margin-left: 20%;
    }

    .calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
        font-size: 16px;
        padding: 10px;
    }

    .calendar div {
        padding: 10px;
        background-color: #eeeeee;
        border-radius: 4px;
        color: #333;
        text-align: center;
    }

    .calendar .day-header {
        font-weight: bold;
        color: #333;
        background-color: #f1c152;
    }

    .calendar .day {
        transition: background-color 0.3s ease;
    }

    .calendar .day:hover {
        background-color: #f1c152;
        cursor: pointer;
    }

    .calendar .current-day {
        background-color: #f1c152;
        color: #fff;
        font-weight: bold;
    }

    .event-section {
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .event-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .event-list li {
        background-color: #eeeeee;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 10px;
        color: #333;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .event-list li:hover {
        background-color: #f1c152;
        color: #fff;
    }

    .event-box {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-height: 500px;
        overflow-y: auto;
    }

    .event-header {
        padding-bottom: 20px;
        border-bottom: 2px solid #f1c152;
    }

    .event-list {
        display: grid;
        grid-template-columns: 1fr;
        row-gap: 10px;
        padding: 0;
        margin-top: 20px;
    }

    .event-list li {
        display: grid;
        grid-template-columns: 1fr 2fr;
        align-items: center;
        background-color: #ffffff;
        border-radius: 8px;
        padding: 10px 20px;
        margin-bottom: 10px;
        color: #333;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .event-list li:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .event-list li:hover {
        background-color: #f1c152;
        color: #333;
        transform: translateY(-5px);

        .event-date {
            font-weight: bold;
            color: #333;
        }
    }

    .event-list li .event-date {
        font-size: 18px;
        font-weight: bold;
        color: #f1c152;
    }

    .event-list li .event-details {
        font-size: 16px;
        margin-left: 10px;
    }

    .event-list li .event-details h4 {
        margin: 0;
        font-size: 18px;
        color: #333;
    }

    .event-list li .event-details p {
        margin: 5px 0 0;
        font-size: 14px;
        color: #666;
    }

    .day {
        padding: 10px;
        margin: 5px;
        border-radius: 50%;
        cursor: pointer;
        text-align: center;
        display: inline-block;
    }

    .calendar .event-day {
        background-color: #f1c152;
        color: #000;
        font-weight: 600;
    }

    .blank-day {
        visibility: hidden;
    }

    .day-header {
        font-weight: bold;
    }

    /* Custom scrollbar styles for Webkit browsers */
    .event-box::-webkit-scrollbar,
    .event-list::-webkit-scrollbar {
        width: 8px;
        /* Thin scrollbar */
    }

    .event-box::-webkit-scrollbar-thumb,
    .event-list::-webkit-scrollbar-thumb {
        background-color: #f1c152;
        /* Scrollbar thumb color */
        border-radius: 4px;
        /* Rounded scrollbar thumb */
        transition: background-color 0.3s ease;
    }

    .event-box::-webkit-scrollbar-thumb:hover,
    .event-list::-webkit-scrollbar-thumb:hover {
        background-color: #d1a74f;
        /* Darker thumb color on hover */
    }

    .event-box::-webkit-scrollbar-track,
    .event-list::-webkit-scrollbar-track {
        background-color: #f5f5f5;
        /* Scrollbar track color */
        border-radius: 4px;
        /* Rounded scrollbar track */
    }

    /* Custom scrollbar styles for Firefox */
    .event-box {
        scrollbar-width: thin;
        /* Thin scrollbar */
        scrollbar-color: #f1c152 #f5f5f5;
        /* Thumb color and track color */
    }


    /* Responsive styles for small screens */
    @media (max-width: 768px) {
        .calendar-nav {
            font-size: 24px;
            /* Smaller font size for buttons */
            padding: 5px;
            /* Adjust padding */
        }
    }

    /* Responsive styles for extra-small screens */
    @media (max-width: 480px) {
        .calendar-container {
            display: flex;
            flex-direction: column;
            /* Stack calendar and events vertically */
            padding: 5px;
            /* Reduce padding further for very small screens */
        }

        .calendar-box,
        .event-box {
            width: 100%;
            /* Ensure boxes take full width */
            margin: 10px 0;
            /* Margin to separate the boxes */
        }

        .calendar {
            font-size: 12px;
            /* Smaller font size for better fit */
            grid-template-columns: repeat(7, 1fr);
            /* Maintain grid layout */
        }

        .calendar div {
            padding: 4px;
            /* Further reduce padding */
            font-size: 10px;
            /* Smaller text size for calendar days */
        }

        .calendar-nav {
            font-size: 18px;
            /* Smaller font size for navigation buttons */
            padding: 2px;
            /* Minimal padding */
        }

        .event-list li {
            padding: 6px 8px;
            /* Adjust padding for event list items */
            font-size: 12px;
            /* Adjust font size for event details */
        }

        .event-list li .event-date {
            font-size: 12px;
            /* Smaller font size for event date */
        }

        .event-list li .event-details h4 {
            font-size: 14px;
            /* Smaller font size for event title */
        }

        .event-list li .event-details p {
            font-size: 10px;
            /* Smaller font size for event description */
        }

        .calendar-nav,
        .event-nav {
            font-size: 16px;
            /* Smaller font size for buttons */
            padding: 4px;
            /* Adjust padding */
        }
    }
</style>

<body>
    <?php require_once('common/navbar.php'); ?>
    <!-- Spinner Start -->

    <!-- Spinner End -->
    <!-- Hero Start -->
    <div class="container-fluid hero-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-header-inner animated zoomIn">
                        <h1 class="display-1 text-dark">Calendar</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-dark" aria-current="page">Calendar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="calendar-section" class="calendar-section">
        <div class="calendar-container">
            <div class="calendar-box">
                <div class="calendar-header">
                    <button id="prev-month" class="calendar-nav">‹</button>
                    <h2 id="calendar-month-year" class="calendar-month-year"></h2>
                    <button id="next-month" class="calendar-nav">›</button>
                </div>
                <div id="calendar" class="calendar"></div>
            </div>
            <div class="event-box">
                <div class="event-header">
                    <h3 class="event-title">Events for <span id="event-month-year"></span></h3>
                </div>
                <ul id="event-list" class="event-list">
                    <!-- Events will be dynamically populated here -->
                </ul>
            </div>
        </div>
    </section>

    <?php require_once('common/footer.php'); ?>
    <?php require_once('common/script.php'); ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>

    <script>
        const calendarContainer = document.getElementById('calendar');
        const calendarMonthYear = document.getElementById('calendar-month-year');
        const eventMonthYear = document.getElementById('event-month-year');
        const eventList = document.getElementById('event-list');
        const prevMonthButton = document.getElementById('prev-month');
        const nextMonthButton = document.getElementById('next-month');

        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();

        const monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // `allCalendar` is defined from PHP
        // let allCalendar = {}; 

        function generateCalendar(month, year) {
            calendarContainer.innerHTML = '';

            calendarMonthYear.textContent = `${monthNames[month]} ${year}`;
            eventMonthYear.textContent = `${monthNames[month]} ${year}`;

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            // Generate day headers
            daysOfWeek.forEach(day => {
                const dayHeader = document.createElement('div');
                dayHeader.textContent = day;
                dayHeader.classList.add('day-header');
                calendarContainer.appendChild(dayHeader);
            });

            // Generate blank days for the first row
            for (let i = 0; i < firstDay; i++) {
                const blankDay = document.createElement('div');
                blankDay.classList.add('blank-day');
                calendarContainer.appendChild(blankDay);
            }

            // Generate the days of the month
            for (let i = 1; i <= daysInMonth; i++) {
                const day = document.createElement('div');
                day.textContent = i;
                day.classList.add('day');

                // Highlight the current day
                const today = new Date();
                if (year === today.getFullYear() && month === today.getMonth() && i === today.getDate()) {
                    day.classList.add('current-day');
                }

                // Highlight days with events
                const dateKey = `${year}-${String(month + 1).padStart(2, '0')}`;
                if (allCalendar[dateKey] && allCalendar[dateKey].some(event => parseInt(event.date, 10) === i)) {
                    day.classList.add('event-day');
                }

                day.addEventListener('click', function() {
                    // Display events for the selected month
                    displayEvents(dateKey);
                });

                calendarContainer.appendChild(day);
            }
        }

        function displayEvents(monthYear) {
            eventList.innerHTML = '';

            if (allCalendar[monthYear]) {
                allCalendar[monthYear].forEach(event => {
                    const listItem = document.createElement('li');
                    listItem.innerHTML = `<div class="event-date">${event.date}</div>
                                  <div class="event-details">
                                      <h4>${event.title}</h4>
                                      <p>Start at ${event.time}-${event.location}</p>
                                  </div>`;
                    eventList.appendChild(listItem);
                });
            } else {
                eventList.innerHTML = '<li>No events yet!</li>';
            }
        }

        prevMonthButton.addEventListener('click', function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendar(currentMonth, currentYear);
            displayEvents(`${currentYear}-${String(currentMonth + 1).padStart(2, '0')}`);
        });

        nextMonthButton.addEventListener('click', function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendar(currentMonth, currentYear);
            displayEvents(`${currentYear}-${String(currentMonth + 1).padStart(2, '0')}`);
        });

        // Initial load
        generateCalendar(currentMonth, currentYear);
        displayEvents(`${currentYear}-${String(currentMonth + 1).padStart(2, '0')}`);
    </script>

</body>

</html>