<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>

<div class="my-3 my-md-5">
  <div class="container">
  
    <div class="row row-cards">

      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Grade Point Average for each semester </h3>
          </div>
          <div class="card-body">
            <div id="chart-area" style="height: 16rem"></div>
          </div>
        </div>
        <script>
          require(['c3', 'jquery'], function(c3, $) {
            $(document).ready(function() {
              var chart = c3.generate({
                bindto: '#chart-area', // id of chart wrapper
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





      <script src="logic.js"></script>

      <div class="col-sm-6 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Upcoming Assignments</h4>
          </div>
          <table class="table card-table">
            <tr>
              <td width="1"><i class="fa fa-tasks text-muted"></i></td>
              <td>CSCI250 Assignment</td>
              <td>Due Date:"18 Auguts"</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Upcoming Exams</h2>
          </div>
          <table class="table card-table">
            <tr>
              <td width="1"><i class="fa fa-tasks text-muted"></i></td>
              <td>CSCI250 Midterm</td>
              <td>Date:"18 Auguts @ 3PM"</td>
            </tr>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<?php require_once("components/footer.php") ?>
</div>
</body>

</html>