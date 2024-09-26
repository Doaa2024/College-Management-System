<?php
require_once('components/header.php');
require_once('components/sidebar.php');
require_once('components/navbar.php');
require_once('DAL/retrieve.class.php');

// Instantiate the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();
$departmentID = isset($_SESSION['departmentID']) ? $_SESSION['departmentID'] : 9;
// Get current month and year
$currentMonth = date('n'); // Current month (1-12)
$currentYear = date('Y');  // Current year (e.g., 2024)

// Determine the semester and year based on the current month
if ($currentMonth >= 12 || $currentMonth < 6) {
    // December to May is Spring
    $newOption = ['Semester' => 'Spring', 'Year' => $currentYear + 1];
} elseif ($currentMonth >= 9 && $currentMonth < 12) {
    // September to November is Fall
    $newOption = ['Semester' => 'Fall', 'Year' => $currentYear];
} elseif ($currentMonth >= 6 && $currentMonth < 9) {
    // June to August is Summer
    $newOption = ['Semester' => 'Summer', 'Year' => $currentYear];
} else {
    // Default to Fall if none of the conditions match
    $newOption = ['Semester' => 'Fall', 'Year' => $currentYear];
}

// Example of existing semesters array (replace this with actual data retrieval)
$semesters = [
    ['Semester' => 'Fall', 'Year' => $currentYear],
    ['Semester' => 'Spring', 'Year' => $currentYear + 1],
    // Add more as needed
];

// Check if the new option already exists in the semesters data
$newOptionExists = false;
foreach ($semesters as $semester) {
    if (
        $semester['Semester'] === $newOption['Semester'] &&
        $semester['Year'] === $newOption['Year']
    ) {
        $newOptionExists = true;
        break;
    }
}

// Assume these variables are set: $semester, $year, $departmentID
$coursesINSemester = $universityData->getCoursesINSemester($newOption['Semester'], $newOption['Year'], $departmentID);
// Map your days to display names
$dayMapping = ['M' => 'Monday', 'T' => 'Tuesday', 'W' => 'Wednesday', 'TH' => 'Thursday', 'F' => 'Friday'];
$daysOfWeek = array_values($dayMapping);  // Extract display names for headers

// Organize data into a structured schedule
$schedule = [];
foreach ($coursesINSemester as $course) {
    $room = $course['RoomName'];
    $dayCodes = explode(',', $course['DayOfWeek']); // Explode by commas if days are concatenated
    $time = $course['time'];
    $courseInfo = $course['CourseName'] . ' (' . $course['CourseCode'] . ')';

    // Initialize room if not already set
    if (!isset($schedule[$room])) {
        $schedule[$room] = array_fill_keys(array_keys($dayMapping), []);
    }

    // Loop through each day code and place the course in the schedule
    foreach ($dayCodes as $dayCode) {
        $dayCode = trim($dayCode); // Trim any extra spaces
        if (isset($schedule[$room][$dayCode])) {
            $schedule[$room][$dayCode][$time] = $courseInfo;
        }
    }
}

// Generate random colors for course cells with low opacity
function getRandomColor()
{
    $colors = [
        'rgba(200, 200, 200, 0.1)', // Light gray
        'rgba(180, 180, 180, 0.1)', // Medium-light gray
        'rgba(150, 150, 150, 0.1)', // Medium gray
        'rgba(120, 120, 120, 0.1)', // Medium-dark gray
        'rgba(90, 90, 90, 0.1)',   // Dark gray
        'rgba(60, 60, 60, 0.1)'    // Very dark gray
    ];
    return $colors[array_rand($colors)];
}
?>

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
    }

    .container {
        margin-top: 30px;
margin-bottom: 30px;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .schedule-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .schedule-table th,
    .schedule-table td {
        border: 1px solid #ddd;
        text-align: center;
        padding: 15px;
        vertical-align: middle;
    }

    .schedule-table th {
        background-color: #4e73df;
        font-weight: bold;
        color: #fff;
    }

    .schedule-table td {
        height: 100px;
        /* Set a minimum height */
        font-size: 14px;
        color: #555;
        position: relative;
    }

    .schedule-table td.room {
        background-color: #fff;
        /* No color for room column */
    }

    .schedule-table td.course {
        background-color: <?= getRandomColor(); ?>;
        /* Random color with low opacity */
    }

    .room-name {
        font-weight: bold;
        color: #2c3e50;
        font-size: 16px;
    }

    .course-info {
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 8px;
        padding: 8px;
        margin: 5px 0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
        display: inline-block;
        width: 90%;
        text-align: left;
    }

    .btn-download {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 50px;
        background-color: #4e73df;
        color: #fff;
        border: none;
        display: flex;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .btn-download:hover {
        background-color: white;
        box-shadow: 0 3px 7px rgba(0, 0, 0, 0.15);
        color: #555;
    }

    .btn-download i {
        margin-right: 8px;
    }
</style>
</head>

<body>
    <div class="container">
        <div class="header-container">
            <h2 class="mb-4">Weekly Schedule: <?= htmlspecialchars($newOption['Semester']) . ' - ' . htmlspecialchars($newOption['Year']) ?></h2>
            <button id="download-pdf" class="btn-download">
                <i class="fas fa-download"></i> Download PDF
            </button>
        </div>
        <table class="schedule-table table table-bordered" id="schedule-table">
            <thead>
                <tr>
                    <th>Room</th>
                    <?php foreach ($daysOfWeek as $day): ?>
                        <th><?= htmlspecialchars($day) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedule as $room => $days): ?>
                    <tr>
                        <td class="room-name room"><?= htmlspecialchars($room) ?></td>
                        <?php foreach (array_keys($dayMapping) as $dayCode): ?>
                            <td class="course" style="background-color: <?= getRandomColor(); ?>;">
                                <?php if (isset($days[$dayCode])): ?>
                                    <?php foreach ($days[$dayCode] as $time => $course): ?>
                                        <div class="course-info">
                                            <strong><?= htmlspecialchars($time) ?></strong>: <?= htmlspecialchars($course) ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php require_once("components/footer.php"); ?>
    <?php require_once("components/scripts.php"); ?>
    <!-- Include JS libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

    <script>
        document.getElementById('download-pdf').addEventListener('click', function() {
            html2canvas(document.getElementById('schedule-table')).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('p', 'mm', 'a4'); // Portrait mode
                const imgWidth = 210; // A4 width in mm
                const pageHeight = 295; // A4 height in mm
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;

                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                pdf.save('schedule.pdf');
            }).catch(function(error) {
                console.error('Error generating PDF:', error);
            });
        });
    </script>

</body>

</html>