<?php
require_once('components/header.php');
require_once('components/sidebar.php');
require_once('components/navbar.php');
require_once('DAL/retrieve.class.php');

$dataRetrieval = new UniversityDataRetrieval();
$facultyID = isset($_SESSION['facultyID']) ? $_SESSION['facultyID'] : 9;
$DepInFac = $dataRetrieval->getAllDepartmentsInFaculty($facultyID);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <title>Study Plan Gantt Chart</title>
</head>

<body>
    <div class="container shadow-lg mb-4">
        <div class="container ">
            <div class="row ">
                <div class="col-md-8 col-lg-6">

                    <form id="departmentForm">
                        <div class="form-group">
                            <label for="departmentSelect" class="font-weight-bold mt-2">Department</label>
                            <select id="departmentSelect" name="dept_id" class="form-control">
                                <?php foreach ($DepInFac as $department): ?>
                                    <option value="<?= $department['DepartmentID']; ?>"><?= $department['DepartmentName']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </form>

                </div>
            </div>



            <!-- Gantt Chart -->
            <div id="gantt_here" class="mb-3 shadow-sm" style="width:100%; min-height:68.5dvh; "></div>
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
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedDepartmentID = <?= json_encode($DepInFac[0]['DepartmentID']); ?>;
            reloadGantt(selectedDepartmentID);
        });

        document.getElementById('departmentSelect').addEventListener('change', function() {
            var selectedDepartmentID = this.value;
            reloadGantt(selectedDepartmentID);
        });

        function reloadGantt(departmentID) {
            gantt.clearAll();
            gantt.init("gantt_here")
            gantt.load("data.php?dept_id=" + departmentID, "json", function() {
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

        // Customize the lightbox to remove the 'Time period' section
        gantt.config.lightbox.sections = [{
            name: "description",
            height: 70,
            map_to: "text",
            type: "textarea",
            focus: true
        }];

        // Remove the "Delete" button from the lightbox
        gantt.config.buttons_left = ["dhx_save_btn"];
        gantt.config.buttons_right = ["dhx_cancel_btn"];

        // Replace the default lightbox header with the semester
        gantt.templates.lightbox_header = function(task) {
            if (!task.start_date) {
                return "Unknown Semester"; // Fallback in case the start_date is missing
            }

            var startDate = new Date(task.start_date);

            // If startDate is invalid, return fallback
            if (isNaN(startDate.getTime())) {
                return "Invalid Date";
            }

            // Adjusted logic: January-June is Fall, July-December is Spring
            var semester = (startDate.getMonth() < 6) ? "Fall" : "Spring";

            // Calculate the year relative to the startYear
            var year = startDate.getFullYear();
            var relativeYear = year - startYear + 1;

            return semester + " Semester, Year " + relativeYear;
        };

        // Helper function to adjust task dates
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

        // Restrict task duration to one semester
        function restrictTaskDuration(task) {
            var semesterMonths = 6;
            var startDate = new Date(task.start_date);
            var endDate = new Date(task.end_date);

            // Calculate the valid end date based on the semester duration
            var validEndDate = new Date(startDate);
            validEndDate.setMonth(startDate.getMonth() + semesterMonths);

            if (endDate > validEndDate) {
                task.end_date = gantt.date.date_to_str(gantt.config.date_format)(validEndDate);
            }
        }

        // Initialize the Gantt chart
        gantt.init("gantt_here");

        // Debugging: Log task and link data after loading
        function debugData(tasks, links) {
            console.log("Loaded Tasks:", tasks);
            console.log("Loaded Links (Prerequisites):", links);

            // Check if any tasks are missing start or end dates
            tasks.forEach(task => {
                if (!task.start_date || !task.end_date) {
                    console.error("Task missing date:", task);
                }
            });

            // Check if any links are missing required data
            links.forEach(link => {
                if (!link.source || !link.target) {
                    console.error("Link missing source or target:", link);
                }
            });
        }

        // Load data for courses and prerequisites (tasks and links)
        gantt.load("data.php", "json", function() {
            var data = gantt.serialize(); // serialize the loaded data
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

            console.log("Gantt chart loaded with tasks and links.");
        });

        // Add event listeners to validate and restrict task dates
        gantt.attachEvent("onBeforeTaskAdd", function(task) {
            restrictTaskDuration(task);
            console.log("Task added:", task);
            return true; // Allow task to be added
        });

        gantt.attachEvent("onBeforeTaskChange", function(id, task) {
            restrictTaskDuration(task);
            console.log("Task changed:", task);
            return true; // Allow task changes
        });

        // Debugging - Log data to console when a task is updated
        gantt.attachEvent("onAfterTaskUpdate", function(id, task) {
            var startDate = new Date(task.start_date);

            // Adjusted logic for Fall and Spring semesters
            var semester = (startDate.getMonth() < 6) ? "Fall" : "Spring";

            // Calculate the academic year
            var academicYear;
            if (semester === "Fall") {
                // For Fall (Jan-Jun), the academic year should NOT decrement the year
                academicYear = startDate.getFullYear() - startYear + 1;
            } else {
                // For Spring (Jul-Dec), the academic year remains the same
                academicYear = startDate.getFullYear() - startYear + 1;
            }

            // Debugging - Log to console
            console.log("Updating task:", task.id);
            console.log("Start date:", task.start_date);
            console.log("End date:", task.end_date);
            console.log("Semester:", semester);
            console.log("Academic year:", academicYear);

            // Send the data to the server via AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "data.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.send(JSON.stringify({
                id: task.id,
                start_date: task.start_date,
                end_date: task.end_date,
                semester: semester,
                year: academicYear
            }));

            // Debugging - Log success message
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log("Task successfully updated in the database.");
                } else {
                    console.log("Failed to update task:", xhr.responseText);
                }
            };
        });

        // Add event listener for link creation (prerequisite added)



        // Add event listener for link update (if the prerequisite is changed)
        gantt.attachEvent("onAfterLinkUpdate", function(id, link) {
            console.log("Link updated:", link);

            // Send updated link data to the server
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "data.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.send(JSON.stringify({
                source: link.source,
                target: link.target,
                type: link.type,
                action: "updateLink", // To signal the server it's an update
                linkId: id
            }));

            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log("Link successfully updated in the database.");
                } else {
                    console.log("Failed to update link:", xhr.responseText);
                }
            };
        });

        gantt.attachEvent("onAfterLinkAdd", function(id, link) {
            console.log("Link added:", link);

            // Send the link data to the server via AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "data.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.send(JSON.stringify({
                source: link.source,
                target: link.target,
                action: "addLink" // Indicate that this is an addition request
            }));

            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log("Link successfully added to the database.");
                } else {
                    console.log("Failed to add link:", xhr.responseText);
                }
            };
        });

        gantt.attachEvent("onAfterLinkDelete", function(id, link) {
            console.log("Link deleted:", link);

            // Send the delete request to the server
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "data.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.send(JSON.stringify({
                action: "deleteLink", // To signal deletion
                source: link.source, // Include source
                target: link.target // Include target
            }));

            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log("Link successfully deleted from the database.");
                } else {
                    console.log("Failed to delete link:", xhr.responseText);
                }
            };
        });
    </script>



    <style>
        /* Customize task appearance */
        .course-task {
            background-color: #87CEEB;
            border-color: #4682B4;
        }
    </style>
    <?php require_once("components/scripts.php"); ?>
    <?php require_once("components/footer.php"); ?>
</body>

</html>