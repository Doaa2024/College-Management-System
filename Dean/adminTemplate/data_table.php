<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>

<?php
// Require the class file
require('DAL/retrieve.class.php');

// Instantiate the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();
?>
<style>
    /* Hide specific pagination buttons */
    .dataTables_wrapper .dataTables_paginate .paginate_button.first,
    .dataTables_wrapper .dataTables_paginate .paginate_button.last {
        display: none;
    }
</style>

<body id="page-top">

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatablesSimple" class="display" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Course Code</th>
                                <th>Credits</th>
                                <th>Published At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


    <script>
        $(document).ready(function() {
            $('#datatablesSimple').DataTable({

                "serverSide": true,
                "ajax": {
                    "url": "actions/data.php",
                    "type": "POST",
                    "data": function(d) {
                        return $.extend({}, d, {
                            // Additional data to send to the server if needed
                        });
                    }
                },
                "columns": [{
                        "data": "CourseName"
                    },
                    {
                        "data": "CourseCode"
                    },
                    {
                        "data": "Credits"
                    },
                    {
                        "data": "CreatedAt"
                    },
                    {
                        "data": "UpdatedAt"
                    },
                    {
                        "data": "Actions",
                        "orderable": false
                    }
                ],
                "pagingType": "full_numbers",
                "language": {

                    "lengthMenu": "Display _MENU_ records per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                },
                "responsive": true
            });
        });
    </script>

    <?php require_once('components/scripts.php'); ?>
    <?php require_once('components/footer.php'); ?>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>



    </html>