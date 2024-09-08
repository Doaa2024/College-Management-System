<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>
<?php require_once('DAL/retrieve.class.php') ?>
<?php
$dataRetrieve = new UniversityDataRetrieval();
$professorID = 6; // Example Professor ID, you can set this dynamically

// Fetch data using the provided functions
$totalStudents = $dataRetrieve->getTotalStudents($professorID);
$avgGpa = $dataRetrieve->getAvgGpa($professorID);
$gradeDistribution = $dataRetrieve->getGradeDistribution($professorID);
$attendanceStatus = $dataRetrieve->getAttendanceStatus($professorID);
$salary = $dataRetrieve->getProfessorSalary($professorID);

$coursesTaught = $dataRetrieve->getCoursesTaught($professorID);
$rating = $dataRetrieve->MyRating($professorID);

?>

<div class="my-3 my-md-5" style="min-height:60dvh">
  <div class="container" >
    <div class="row row-cards">

      <!-- Total Students -->
      <div class="col-lg-3">
        <div class="card align-items-center"  style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
          <div class="card-header align-items-center" style="background: linear-gradient(to bottom right, #007bff, #00c6ff); box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2); width:100%; color:white;" >
            <h3 class="card-title">Students Rating of Me</h3>
          </div>
          <div class="card-body font-weight-bold" style="font-size: 1.5rem;">
            <p><?php echo $rating[0]['avg_rating']; ?>/5</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card align-items-center" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
          <div class="card-header" style="background: linear-gradient(to bottom right, #007bff, #00c6ff); box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2); width:100%; color:white;">
            <h3 class="card-title">Total Students @ My Courses</h3>
          </div>
          <div class="card-body font-weight-bold" style="font-size: 1.5rem;">
            <p><?php echo $totalStudents[0]['total_students']; ?></p>
          </div>
        </div>
      </div>

      <!-- Average GPA -->
      <div class="col-lg-3">
        <div class="card align-items-center" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
          <div class="card-header" style="background: linear-gradient(to bottom right, #007bff, #00c6ff); box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2); width:100%; color:white;">
            <h3 class="card-title">My Salary</h3>
          </div>
          <div class="card-body font-weight-bold" style="font-size: 1.5rem;">
            <p><?php echo $salary[0]['Salary']; ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card align-items-center" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
          <div class="card-header" style="background: linear-gradient(to bottom right, #007bff, #00c6ff); box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2); width:100%; color:white;">
            <h3 class="card-title">Courses Taught</h3>
          </div>
          <div class="card-body font-weight-bold " style="font-size: 1.5rem;">
            <p><?php echo $coursesTaught[0]['courses_taught']; ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
          <div class="card-header" style="background: linear-gradient(to bottom right, #007bff, #00c6ff); box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2); width:100%; color:white;">
            <h3 class="card-title">Grade Distribution</h3>
          </div>
          <div class="card-body" height="max-content">
            <div id="chart-bar" style="height: 20rem;"></div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
          <div class="card-header" style="background: linear-gradient(to bottom right, #007bff, #00c6ff); box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2); width:100%; color:white;">
            <h3 class="card-title">Average Attendance Status in All Courses</h3>
          </div>
          <div class="card-body" height="max-content">
            <div id="chart-donut" style="height: 20rem;"></div>
          </div>
        </div>
      </div>



    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Data for Grade Distribution
    var gradeDistributionData = <?php echo json_encode($gradeDistribution); ?>;
    var gradeLabels = gradeDistributionData.map(function(item) {
      return item.Grade;
    });
    var gradeCounts = gradeDistributionData.map(function(item) {
      return item.count;
    });

    // Bar Chart for Grade Distribution
    c3.generate({
      bindto: '#chart-bar',
      data: {
        columns: [
          ['Grades'].concat(gradeCounts)
        ],
        type: 'bar',
        colors: {
          'Grades': '#66b3ff'
        }
      },
      axis: {
        x: {
          type: 'category',
          categories: gradeLabels,
          label: 'Grades'
        },
        y: {
          label: 'Number of Students'
        }
      },
      bar: {
        width: {
          ratio: 0.5 // Adjust bar width
        }
      }
    });


    // Data for Attendance Status
    var attendanceData = <?php echo json_encode($attendanceStatus); ?>;

    // Prepare data arrays for each status type
    var statusCounts = {
      Present: 0,
      Absent: 0,
      Late: 0
    };

    // Map the attendance data to the correct status counts
    attendanceData.forEach(function(item) {
      if (statusCounts.hasOwnProperty(item.Status)) {
        statusCounts[item.Status] = item.count;
      }
    });

    // Donut Chart for Attendance Status
    c3.generate({
      bindto: '#chart-donut',
      data: {
        columns: [
          ['Present', statusCounts.Present],
          ['Absent', statusCounts.Absent],
          ['Late', statusCounts.Late]
        ],
        type: 'donut',
        colors: {
          'Present': '#99ff99',
          'Absent': '#ff9999',
          'Late': '#ffcc99'
        }
      },

    });
  });
</script>


<?php require_once("components/footer.php") ?>

</body>

</html>