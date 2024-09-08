<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>
<?php require_once('DAL/retrieve.class.php') ?>

<?php
$dataRetrieve = new UniversityDataRetrieval();

$professorID = 6; // Example Professor ID, you can set this dynamically

// Fetch schedule data
$Sched = $dataRetrieve->getProfessorSchedule($professorID);

// Group the schedule by day
$daysOfWeek = ['M', 'T', 'W', 'TH', 'F'];
$groupedSchedule = [];
foreach ($daysOfWeek as $day) {
    $groupedSchedule[$day] = [];
}
foreach ($Sched as $schedule) {
    $days = explode(',', $schedule['DayOfWeek']);
    foreach ($days as $day) {
        $day = trim($day); // Clean up any extra spaces
        if (array_key_exists($day, $groupedSchedule)) {
            $groupedSchedule[$day][] = $schedule;
        }
    }
}

// Sort the schedule for each day by StartTime (extracted from 'time' field)
foreach ($groupedSchedule as $day => &$schedules) {
    usort($schedules, function($a, $b) {
        $timeA = explode('-', $a['time']);
        $timeB = explode('-', $b['time']);

        // Extract StartTime from 'time' field
        $startTimeA = strtotime($timeA[0]); // e.g., "9:30"
        $startTimeB = strtotime($timeB[0]); // e.g., "8:00"

        return $startTimeA - $startTimeB;
    });
}
?>

<div class="container mt-5" style="min-height:70dvh;">
    <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
        <div class="card-header bg-primary text-white">
            <h4>Professor's Schedule</h4>
        </div>
        <div class="card-body" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
            <?php if (!empty($Sched)) : ?>
                <table class="table table-bordered" id="scheduleTable" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-white">Day</th>
                            <th class="text-white">Course Name</th>
                            <th class="text-white">Start Time</th>
                            <th class="text-white">End Time</th>
                            <th class="text-white">Room</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($daysOfWeek as $day) : ?>
                            <?php if (!empty($groupedSchedule[$day])) : ?>
                                <?php foreach ($groupedSchedule[$day] as $index => $schedule) : 
                                    $timeParts = explode('-', ($schedule['time']));

                                    $startTime = $timeParts[0]; // e.g., "9:30"
                                    $endTime = $timeParts[1]; // e.g., "10:45" ?>
                                    <tr>
                                        <?php if ($index === 0) : ?>
                                            <td rowspan="<?= count($groupedSchedule[$day]); ?>"><?= htmlspecialchars($day); ?></td>
                                        <?php endif; ?>
                                        <td><?= htmlspecialchars($schedule['CourseName']); ?></td>
                                        <td><?= $startTime ?></td>
                                        <td><?= $endTime ?></td>
                                        <td><?= htmlspecialchars($schedule['RoomName']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-right mt-3">
                    <button id="download-pdf" class="btn btn-primary">Download PDF</button>
                </div>
            <?php else : ?>
                <p>No schedule available for this professor.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    document.getElementById('download-pdf').addEventListener('click', function() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();

        // Get the HTML content
        const content = document.getElementById('scheduleTable');

        // Ensure html2canvas is loaded
        if (typeof html2canvas !== 'undefined') {
            doc.text("Professor's Schedule", 20, 10);
            doc.html(content, {
                callback: function(doc) {
                    // Save the PDF
                    doc.save("professor_schedule.pdf");
                },
                x: 20,
                y: 20,
                html2canvas: {
                    scale: 0.155555555555555 // Adjust the scale to make the content fit better
                }
            });
        } else {
            console.error("html2canvas not loaded properly.");
        }
    });
</script>

<?php require_once("components/footer.php") ?>
