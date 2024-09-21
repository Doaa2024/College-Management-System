<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php');
require_once('DAL/retrieve.class.php');

$dataRetrieval = new UniversityDataRetrieval();

$userID = isset($_GET['userID']) ? intval($_GET['userID']) : 5;
$userInfo = $dataRetrieval->getUserInfo($userID);
?>


<div class="container shadow-lg mb-4 col-lg-11">
    <div class="container pb-5 mt-4">
        <!-- Gantt Chart -->
        <div id="gantt_here" class="mb-4 shadow-lg col-lg-12" style="width:100%; min-height:68.5dvh; "></div>
    </div>


</div>
<style>
    /* Customizing Gantt chart to use Bootstrap primary color */
    .gantt_task_content {
        background-color: #4e73df !important;
        /* Bootstrap primary color */
    }

    .gantt_grid_head_cell,
    .gantt_grid_data .gantt_cell {
        background-color: #4e73df;
        /* Bootstrap primary color */
        color: white;
        /* Text color for contrast */
    }

    .gantt_task_line {
        background-color: #007bff !important;
        /* Bar color */
        border-color: #0056b3 !important;
        /* Darker primary color for border */
    }

    .gantt_task_row {
        background-color: #e9ecef;
        /* Light background for grid */
    }

    .gantt_grid_head_cell {
        color: white;
        /* White text for headers */
    }

    .gantt_task_drag {
        background-color: #4e73df !important;
        /* Darker primary when dragging */
    }

    #gantt_here {
        /* width: 100vw!important; 
    height: 100vh!important;  */
        margin: 0 !important;
        padding: 0 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectedDepartmentID = <?= json_encode($userInfo[0]['DepartmentID']); ?>;
        reloadGantt(selectedDepartmentID);
        gantt.config.readonly = true;
    });


    function reloadGantt(departmentID) {
        gantt.clearAll();
        gantt.init("gantt_here")
        gantt.load("../../Dean/adminTemplate/data.php?dept_id=" + departmentID, "json", function() {
            var data = gantt.serialize(); // Serialize the loaded data
            var tasks = data.data; // Extract tasks (courses)
            var links = data.links; // Extract links (prerequisites)

            // Debugging: log the loaded tasks and links
            debugData(tasks, links);

            // Adjust task dates
            adjustTaskDates(tasks);

            // Parse tasks and links into Gantt chart
            gantt.parse({
                data: tasks,
                links: links // Include the links data here
            });

            console.log("Gantt chart reloaded with tasks and links.");
        });
    }

    // Configuration for the study plan Gantt chart
    gantt.config.date_format = "%Y-%m-%d";

    gantt.config.columns = [{
        name: "text",
        label: "Course",
        tree: true,
        width: 250
    }];

    // Set default task dimensions
    gantt.config.task_height = 30;
    gantt.config.row_height = 40;

    // Define the Gantt timeline for 5 years
    var startYear = 2020;
    gantt.config.start_date = new Date(startYear, 0, 1); // Start in January 2020
    gantt.config.end_date = new Date(startYear + 5, 0, 1); // End in January of the 5th year

    // Set custom scale to show Year 1, Year 2, etc.
    gantt.config.scales = [{
            unit: "year",
            step: 1,
            // width: 250,
            format: function(date) {
                var yearIndex = date.getFullYear() - startYear + 1;
                return "Year " + yearIndex;
            }
        },
        {
            unit: "month",
            step: 6,
            format: function(date) {
                // Change logic: January-June (Fall), July-December (Spring)
                return (date.getMonth() < 6) ? "Fall" : "Spring";
            }
        }
    ];

    // Disable all editing (read-only mode)
    gantt.config.readonly = true;

    // Initialize the Gantt chart
    gantt.init("gantt_here");

    // Debugging: Log task and link data after loading
    function debugData(tasks, links) {
        console.log("Loaded Tasks:", tasks);
        console.log("Loaded Links (Prerequisites):", links);
    }

    // Adjust task dates for display purposes
    function adjustTaskDates(tasks) {
        var semesterMonths = 6;
        tasks.forEach(task => {
            if (!task.start_date) {
                task.start_date = gantt.config.start_date;
            }
            var startDate = new Date(task.start_date);
            var endDate = new Date(startDate);
            endDate.setMonth(startDate.getMonth() + semesterMonths);
            task.end_date = gantt.date.date_to_str(gantt.config.date_format)(endDate);
        });
    }
</script>

<style>
    /* Customize task appearance */
    .course-task {
        background-color: #87CEEB;
        border-color: #4682B4;
    }
</style>


<script src="logic.js"></script>
<?php require_once("components/footer.php") ?>

</body>

</html>