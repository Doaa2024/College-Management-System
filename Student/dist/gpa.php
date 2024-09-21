<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>
<?php require_once('DAL/retrieve.class.php');

// Create an instance of the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();

// Retrieve userID from GET, with a default value of 3 if not provided
$userID = isset($_GET['userID']) ? intval($_GET['userID']) : 3;


// Fetch the total credits and fees for the student based on the selected semester and year
$gpa = $universityData->getStudentGPA($userID);
?>
<!-- Include jqPlot CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/jquery.jqplot.min.css">
<div class="my-3 my-md-5">
    <div class="container" style="min-height:70dvh">

        <div class="row row-cards">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Grade Point Average for each semester </h3>
                    </div>
                    <div class="card-body" id="card-body">

                    </div>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

                <!-- Include jqPlot JS -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/jquery.jqplot.min.js"></script>

                <!-- Include MeterGaugeRenderer Plugin -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/plugins/jqplot.meterGaugeRenderer.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Example GPA value
                        var gpaValue = <?php echo json_encode($gpa) ?>;

                        // GPA Meter with range from 0 to 4, with 0.5 steps
                        var s1 = [gpaValue];

                        var plot3 = $.jqplot('card-body', [s1], {
                            seriesDefaults: {
                                renderer: $.jqplot.MeterGaugeRenderer,
                                rendererOptions: {
                                    min: 0,
                                    max: 4, // Maximum GPA
                                    intervals: [0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4], // 0.5 step intervals
                                    intervalColors: [
                                        '#ff0000', '#ff3333', '#ff6666', '#ff9999', // Red shades
                                        '#b3ffb3', '#80ff80', '#4dff4d', '#00ff00' // Brighter green shades
                                    ],
                                    ticks: [0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4], // Tick marks
                                    label: 'GPA', // Label under the meter
                                    labelHeightAdjust: -5,
                                    padding: 10,
                                    style: {
                                        border: 0
                                    },
                                    gaugeStyle: 'half', // Render half-circle gauge
                                }
                            }
                        });
                    });
                </script>

                <script>
                    require(['c3', 'jquery'], function(c3, $) {
                        $(document).ready(function() {
                            var chart = c3.generate({
                                bindto: '', // id of chart wrapper
                                data: {
                                    columns: [
                                        // each columns data
                                        ['data1', 11, 8, 15, 18, 19, 17]

                                    ],
                                    type: 'area', // default type of chart
                                    colors: {
                                        'data1': tabler.colors["blue"],

                                    },
                                    names: {
                                        // name of each serie
                                        'data1': 'GPA',

                                    }
                                },
                                axis: {
                                    x: {
                                        type: 'category',
                                        // name of each category
                                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                                    },
                                },
                                legend: {
                                    show: false, //hide legend
                                },
                                padding: {
                                    bottom: 0,
                                    top: 0
                                },
                            });
                        });
                    });
                </script>
            </div>
            <div class="col-md-6">
                <div class="alert alert-primary">Your Academic Profile? See Below!</a> </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Course Enrollment Status</h3>


                            </div>
                            <div class="card-body">
                                <div id="chart-donut" style="height: 12rem;"></div>
                            </div>
                        </div>
                        <script>
                            require(['c3', 'jquery'], function(c3, $) {
                                $(document).ready(function() {
                                    var chart = c3.generate({
                                        bindto: '#chart-donut', // id of chart wrapper
                                        data: {
                                            columns: [
                                                // each columns data
                                                ['data1', 63],
                                                ['data2', 37]
                                            ],
                                            type: 'donut', // default type of chart
                                            colors: {
                                                'data1': tabler.colors["green-light"],
                                                'data2': tabler.colors["green"]
                                            },
                                            names: {
                                                // name of each serie
                                                'data1': 'Courses Completed',
                                                'data2': 'Courses Remaining to Graduate'
                                            }
                                        },
                                        axis: {},
                                        legend: {
                                            show: false, //hide legend
                                        },
                                        padding: {
                                            bottom: 0,
                                            top: 0
                                        },
                                    });
                                });
                            });
                        </script>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Course Grades Distribution</h3>
                                <br>

                            </div>
                            <div class="card-body">
                                <div id="chart-pie" style="height: 12rem;"></div>
                            </div>
                        </div>
                        <script>
                            require(['c3', 'jquery'], function(c3, $) {
                                $(document).ready(function() {
                                    var chart = c3.generate({
                                        bindto: '#chart-pie', // id of chart wrapper
                                        data: {
                                            columns: [
                                                // each columns data
                                                ['data1', 63],
                                                ['data2', 44],
                                                ['data3', 12],
                                                ['data4', 14]
                                            ],
                                            type: 'pie', // default type of chart
                                            colors: {
                                                'data1': tabler.colors["blue-darker"],
                                                'data2': tabler.colors["blue"],
                                                'data3': tabler.colors["blue-light"],
                                                'data4': tabler.colors["blue-lighter"]
                                            },
                                            names: {
                                                // name of each serie
                                                'data1': 'A',
                                                'data2': 'B',
                                                'data3': 'C',
                                                'data4': 'D'
                                            }
                                        },
                                        axis: {},
                                        legend: {
                                            show: false, //hide legend
                                        },
                                        padding: {
                                            bottom: 0,
                                            top: 0
                                        },
                                    });
                                });
                            });
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</div>
<?php require_once("components/footer.php") ?>

</body>

</html>