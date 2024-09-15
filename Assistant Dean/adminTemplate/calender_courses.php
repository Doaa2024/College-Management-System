<?php
require_once('components/header.php');
require_once('components/sidebar.php');
require_once('components/navbar.php');
require_once('DAL/retrieve.class.php');

// Instantiate the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();
$events = $universityData->getAllEvents();
$branches = $universityData->getAllBranches();
// Function to get a random description
function getRandomDescription($descriptions)
{
    return $descriptions[array_rand($descriptions)];
}

// Function to generate a random hex color
function getRandomColor()
{
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

// Assume $events is already defined and contains your event data
$formattedEvents = array_map(function ($event) {
    $start = $event['EventDate'] . 'T' . $event['StartTime'];
    $end = $event['EventDate'] . 'T' . $event['EndTime'];
    $description = $event['Description']; // Fetch description from event data
    $location = $event['BranchName'];
    $createdby = $event['UserName'];
    $starttime = $event['StartTime'];
    $endtime = $event['EndTime'];
    $startdate = $event['EventDate'];
    $enddate = $event['EndDate'];
    $id = $event['EventID'];
    if (!empty($event['EndDate']) && $event['EndDate'] !== $event['EventDate']) {
        $end = $event['EndDate'] . 'T' . $event['EndTime'];
    }

    return [
        'title' => $event['EventName'],
        'start' => $start,
        'end' => $end,
        'startTime1' => $starttime,
        'endTime1' => $endtime,
        'eventDate1' => $startdate,
        'endDate1' => $enddate,
        'color' => getRandomColor(), // Assign a random color
        'description' => $description, // Assign description
        'location' => $location,
        'createdby' => $createdby,
        'id' => $id
    ];
}, $events);
$eventsJson = json_encode($formattedEvents);
?>

<style>
    #calendar {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
        max-width: 1100px;
        margin: 40px auto;
    }

    .fc .fc-button {
        background-color: blue;
        border: blue;
        color: var(--fc-button-text-color);
    }

    .fc .fc-toolbar-title {
        font-size: 2em;
        margin: 0px;
        font-weight: bold;
        color: blue;
        opacity: 0.6;
    }

    .fc .fc-button-primary:not(:disabled).fc-button-active,
    .fc .fc-button-primary:not(:disabled):active {
        background-color: blue;
        border-color: blue;
        color: var(--fc-button-text-color);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .fc .fc-toolbar-title {
            font-size: 1.2em;
            /* Smaller font size for smaller screens */
        }

        .fc .fc-button {
            font-size: 12px;
            /* Adjust button text size */
            padding: 8px;
            /* Less padding on smaller screens */
        }
    }

    @media (max-width: 480px) {
        .fc .fc-toolbar-title {
            font-size: 1em;
            /* Further reduce font size for very small screens */
        }

        .fc .fc-button {
            font-size: 10px;
            /* Further adjust button text size */
            padding: 6px;
            /* Less padding for very small screens */
        }
    }

    .demo-topbar {
        background: #eee;
        border-bottom: 1px solid #ddd;
        color: #000 !important;
        font-family: Lucida Grande, Helvetica, Arial, Verdana, sans-serif !important;
        font-size: 14px !important;
        height: 40px;
        line-height: 40px;
        padding-left: 1em
    }

    .demo-topbar .codepen-button {
        float: right;
        background: blue !important;
        margin-right: 7px;
        margin-top: 7px
    }

    .codepen-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background: blue !important;
        border: 1px solid #ddd;
        border-radius: 4px;
        color: #000 !important;
        cursor: pointer;
        font-family: Lucida Grande, Helvetica, Arial, Verdana, sans-serif !important;
        font-size: 11px !important;
        height: 26px;
        line-height: 26px;
        padding: 0 6px
    }

    .codepen-button:after {
        content: "↗";
        margin: -50% 0 -50% 2px;
        vertical-align: middle
    }

    .tooltip {
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 5px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        margin-top: -25px;
        display: none;
        /* Initially hidden */
        pointer-events: none;
        /* Avoid tooltip blocking event interactions */
    }

    .tooltip.show {
        display: block;
    }
</style>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var events = <?php echo $eventsJson; ?>;

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            initialDate: getCurrentDateISO(),
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            events: events,
            selectable: true,

            eventDidMount: function(info) {
                // Create tooltip element
                var tooltip = document.createElement('div');
                tooltip.className = 'tooltip';

                // Set the tooltip content with description, location, and createdby
                var location = info.event.extendedProps.location || 'No location';
                var createdby = info.event.extendedProps.createdby || 'Unknown creator';
                var description = info.event.extendedProps.description || 'No description';

                // Combine the information into the tooltip content
                tooltip.innerText = `Location: ${location}\nCreated by: ${createdby}\nDescription: ${description}`;

                document.body.appendChild(tooltip);

                // Show tooltip on hover
                info.el.addEventListener('mouseover', function(event) {
                    var rect = info.el.getBoundingClientRect();
                    tooltip.style.left = (rect.left + window.scrollX + 10) + 'px';
                    tooltip.style.top = (rect.top + window.scrollY - tooltip.offsetHeight - 10) + 'px';
                    tooltip.classList.add('show');
                });

                // Hide tooltip on mouseout
                info.el.addEventListener('mouseout', function() {
                    tooltip.classList.remove('show');
                });

            },

            select: async function(start, end, allDay) {
                const {
                    value: formValues
                } = await Swal.fire({
                    title: 'Add Event',
                    html: `
    <style>
        .swal2-input {
            width: 100%;
            max-width: 390px; /* Sets a maximum width for better responsiveness */
            padding: 0px; /* Adds padding inside the elements */
            margin-bottom: 15px; /* Adds space between each element */
            border: 1px solid #ccc; /* Sets a light border for a clean look */
            border-radius: 5px; /* Rounds the corners slightly */
            box-sizing: border-box; /* Ensures padding and border are included in the total width and height */
            font-size: 16px; /* Ensures a readable font size */
            outline: none; /* Removes the default outline on focus */
            transition: border-color 0.3s ease-in-out; /* Smooth transition for the border color */
            overflow-x: hidden;
            color:#333;
        }
        .swal2-input:focus {
            border-color: #007BFF; /* Changes border color on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Adds a subtle shadow on focus */
        }
        #swalEvtDesc {
            resize: none; /* Prevents resizing of the textarea */
            height: 100px; /* Sets a consistent height for the textarea */
        }
             .swal2-title {
                color: blue; /* Sets the title color to blue */
            }
                  .swal2-confirm {
                background-color: blue; /* Sets the button background color to blue */
                color: white; /* Sets the button text color to white */
                border: none; /* Removes border */
                border-radius: 5px; /* Adds rounding to the button */
                padding: 10px 20px; /* Adds padding inside the button */
                font-size: 16px; /* Sets a readable font size */
                cursor: pointer; /* Changes cursor to pointer on hover */
                transition: background-color 0.3s ease-in-out; /* Smooth transition for the background color */
            }
            .swal2-confirm:hover {
                background-color: #0056b3; /* Darker blue on hover */
            }
                /* Styling for placeholder color */
            .swal2-input::placeholder {
                color: gray; /* Sets the placeholder text color to gray */
                opacity: 1; /* Ensures full visibility of placeholder color */
            }
           
    </style>

    <input id="swalEvtTitle" class="swal2-input" placeholder="Enter Event Name">
    <textarea id="swalEvtDesc" class="swal2-input" placeholder="Enter Event Description"></textarea>
  <select id="swalEvtURL" class="swal2-input">
    <option value="" disabled selected>Choose Location</option>
    <?php
    // Assuming $branches is an array of associative arrays with 'BranchID' and 'BranchName' keys
    foreach ($branches as $branch) {
        echo '<option value="' . htmlspecialchars($branch['BranchID']) . '">' . htmlspecialchars($branch['BranchName']) . '</option>';
    }
    ?>
</select>

`,

                    focusConfirm: false,
                    preConfirm: () => {
                        return [
                            document.getElementById('swalEvtTitle').value,
                            document.getElementById('swalEvtDesc').value,
                            document.getElementById('swalEvtURL').value
                        ]
                    }
                });

                if (formValues) {
                    // Add event
                    fetch("actions/eventHandler.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                request_type: 'addEvent',
                                start: start.startStr,
                                end: start.endStr,
                                event_data: formValues
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status == 1) {
                                Swal.fire({
                                    title: 'Event added successfully!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Reload the page after the alert is confirmed
                                        location.reload();
                                    }
                                });

                            } else {
                                Swal.fire(data.error, '', 'error');
                            }

                            // Refetch events from all sources and rerender
                            calendar.refetchEvents();
                        })
                        .catch(console.error);
                }
            },
            eventClick: function(info) {
                info.jsEvent.preventDefault();

                // change the border color
                info.el.style.borderColor = 'red';

                Swal.fire({
                    title: info.event.title,
                    icon: 'info',
                    html: '<p>' + info.event.extendedProps.description + '</p><a href="' + info.event.url + '">Visit event page</a>',
                    showCloseButton: true,
                    showCancelButton: true,
                    showDenyButton: true,
                    cancelButtonText: 'Close',
                    confirmButtonText: 'Delete',
                    denyButtonText: 'Edit',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Delete event
                        fetch("actions/eventHandler.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    request_type: 'deleteEvent',
                                    event_id: info.event.id
                                }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status == 1) {
                                    Swal.fire({
                                        title: 'Event Deleted successfully!',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Reload the page after the alert is confirmed
                                            location.reload();
                                        }
                                    });

                                } else {
                                    Swal.fire(data.error, '', 'error');
                                }

                                // Refetch events from all sources and rerender
                                calendar.refetchEvents();
                            })
                            .catch(console.error);
                    } else if (result.isDenied) {
                        // Edit and update event
                        Swal.fire({
                            title: 'Edit Event',
                            html: `
    <style>
        .swal2-input {
            width: 100%;
            max-width: 390px; /* Sets a maximum width for better responsiveness */
            padding: 10px; /* Adds padding inside the elements */
            margin-bottom: 15px; /* Adds space between each element */
            border: 1px solid #ccc; /* Sets a light border for a clean look */
            border-radius: 5px; /* Rounds the corners slightly */
            box-sizing: border-box; /* Ensures padding and border are included in the total width and height */
            font-size: 16px; /* Ensures a readable font size */
            outline: none; /* Removes the default outline on focus */
            transition: border-color 0.3s ease-in-out; /* Smooth transition for the border color */
            overflow-x: hidden;
            color: #333;
        }
        .swal2-input:focus {
            border-color: #007BFF; /* Changes border color on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Adds a subtle shadow on focus */
        }
        #swalEvtDesc_edit {
            resize: none; /* Prevents resizing of the textarea */
            height: 100px; /* Sets a consistent height for the textarea */
        }
        .swal2-title {
            color: blue; /* Sets the title color to blue */
        }
        .swal2-confirm {
            background-color: blue; /* Sets the button background color to blue */
            color: white; /* Sets the button text color to white */
            border: none; /* Removes border */
            border-radius: 5px; /* Adds rounding to the button */
            padding: 10px 20px; /* Adds padding inside the button */
            font-size: 16px; /* Sets a readable font size */
            cursor: pointer; /* Changes cursor to pointer on hover */
            transition: background-color 0.3s ease-in-out; /* Smooth transition for the background color */
        }
        .swal2-confirm:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        /* Styling for placeholder color */
        .swal2-input::placeholder {
            color: gray; /* Sets the placeholder text color to gray */
            opacity: 1; /* Ensures full visibility of placeholder color */
        }
    </style>
<input id="swalEvtTitle_edit" class="swal2-input" placeholder="Enter title" value="${info.event.title}">
<textarea id="swalEvtDesc_edit" class="swal2-input" placeholder="Enter description">${info.event.extendedProps.description}</textarea>

<select id="swalEvtLocation_edit" class="swal2-input">
    <option value="" disabled>Choose Location</option>
    <?php
    // Assuming $branches is an array of associative arrays with 'BranchID' and 'BranchName' keys
    foreach ($branches as $branch) {
        echo '<option value="' . htmlspecialchars($branch['BranchID']) . '" 
        ' . '${info.event.extendedProps.location === "' . htmlspecialchars($branch['BranchName']) . '" ? "selected" : ""}' . '>'
            . htmlspecialchars($branch['BranchName']) . '</option>';
    }
    ?>
</select>

<!-- Date fields -->
<input type="date" id="swalEvtDate1_edit" class="swal2-input" placeholder="Enter date 1" value="${info.event.extendedProps.eventDate1}">
<input type="date" id="swalEvtDate2_edit" class="swal2-input" placeholder="Enter date 2" value="${info.event.extendedProps.endDate1}">
<!-- Time fields -->
<input type="time" id="swalEvtTime1_edit" class="swal2-input" placeholder="Enter time 1"  value="${info.event.extendedProps.startTime1}">
<input type="time" id="swalEvtTime2_edit" class="swal2-input" placeholder="Enter time 2" value="${info.event.extendedProps.endTime1}">


</select>

            `,
                            focusConfirm: false,
                            confirmButtonText: 'Submit',

                            preConfirm: () => {
                                return [
                                    document.getElementById('swalEvtTitle_edit').value,
                                    document.getElementById('swalEvtDesc_edit').value,
                                    document.getElementById('swalEvtLocation_edit').value,
                                    document.getElementById('swalEvtDate1_edit').value,
                                    document.getElementById('swalEvtDate2_edit').value,
                                    document.getElementById('swalEvtTime1_edit').value,
                                    document.getElementById('swalEvtTime2_edit').value

                                ]
                            }
                        }).then((result) => {
                            if (result.value) {
                                // Edit event
                                fetch("actions/eventHandler.php", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json"
                                        },
                                        body: JSON.stringify({
                                            request_type: 'editEvent',
                                            start: info.event.startStr,
                                            end: info.event.endStr,
                                            event_id: info.event.id,
                                            event_data: result.value
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.status == 1) {
                                            Swal.fire({
                                                title: 'Event Updated successfully!',
                                                icon: 'success',
                                                confirmButtonText: 'OK'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    // Reload the page after the alert is confirmed
                                                    location.reload();
                                                }
                                            });
                                        } else {
                                            Swal.fire(data.error, '', 'error');
                                        }

                                        // Refetch events from all sources and rerender
                                        calendar.refetchEvents();
                                    })
                                    .catch(console.error);
                            }
                        });
                    } else {
                        Swal.close();
                    }
                });
            }
        });

        calendar.render();
    });

    function getCurrentDateISO() {
        var today = new Date();
        var year = today.getFullYear();
        var month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
        var day = String(today.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
</script>



</head>

<body>
    <div class="tooltip">This is a tooltip</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var eventElement = document.querySelector('.event');
            var tooltip = document.querySelector('.tooltip');

            eventElement.addEventListener('mouseover', function(event) {
                var rect = eventElement.getBoundingClientRect();
                tooltip.style.left = (rect.left + window.scrollX + 10) + 'px';
                tooltip.style.top = (rect.top + window.scrollY - tooltip.offsetHeight - 10) + 'px';
                tooltip.classList.add('show');
            });

            eventElement.addEventListener('mouseout', function() {
                tooltip.classList.remove('show');
            });
        });
    </script>
    <div id='calendar'></div>
    <?php require_once("components/footer.php"); ?>
    <?php require_once("components/scripts.php"); ?>
</body>