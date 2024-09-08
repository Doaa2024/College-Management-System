<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>
<?php require_once('DAL/retrieve.class.php') ?>

<?php
$dataRetrieve = new UniversityDataRetrieval();

$professorID = 6; // Example Professor ID, you can set this dynamically

// Fetch office hours data
$OA = $dataRetrieve->getOfficeHours($professorID);

// Group the office hours by day
$groupedOfficeHours = [];
foreach ($OA as $officeHour) {
    $day = $officeHour['DayOfWeek'];
    if (!isset($groupedOfficeHours[$day])) {
        $groupedOfficeHours[$day] = [];
    }
    $groupedOfficeHours[$day][] = $officeHour;
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Add Office Hours Modal -->
<div class="modal fade" id="addOfficeHoursModal" tabindex="-1" role="dialog" aria-labelledby="addOfficeHoursModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOfficeHoursModalLabel">Add Office Hours</h5>

            </div>
            <form id="addOfficeHoursForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addDayOfWeek">Day of Week</label>
                        <select class="form-control" id="addDayOfWeek" name="DayOfWeek" required>
                            <option value="" disabled selected>Select a day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="addStartTime">Start Time</label>
                        <input type="time" class="form-control" id="addStartTime" name="StartTime" required>
                    </div>
                    <div class="form-group">
                        <label for="addEndTime">End Time</label>
                        <input type="time" class="form-control" id="addEndTime" name="EndTime" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Office Hours Modal -->
<div class="modal fade" id="editOfficeHoursModal" tabindex="-1" role="dialog" aria-labelledby="editOfficeHoursModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOfficeHoursModalLabel">Edit Office Hours</h5>

            </div>
            <form id="editOfficeHoursForm">
                <div class="modal-body">
                    <input type="hidden" id="editOfficeHourID" name="OfficeHourID">
                    <div class="form-group">
                        <label for="editDayOfWeek">Day of Week</label>
                        <input type="text" class="form-control" id="editDayOfWeek" name="DayOfWeek" required>
                    </div>
                    <div class="form-group">
                        <label for="editStartTime">Start Time</label>
                        <input type="time" class="form-control" id="editStartTime" name="StartTime" required>
                    </div>
                    <div class="form-group">
                        <label for="editEndTime">End Time</label>
                        <input type="time" class="form-control" id="editEndTime" name="EndTime" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5" style="min-height:70dvh;">
    <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
        <div class="card-header bg-primary text-white">
            <h4>Professor's Office Hours</h4>
        </div>
        <div class="card-body" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
            <?php if (!empty($OA)) : ?>
                <table class="table table-striped table-bordered" id="officeHoursTable" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
                    <thead class="thead bg-primary text-white">
                        <tr>
                            <th class="text-white">Day of Week</th>
                            <th class="text-white">Start Time</th>
                            <th class="text-white">End Time</th>
                            <th class="text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $first = true;
                        foreach ($groupedOfficeHours as $day => $officeHours) :
                            foreach ($officeHours as $index => $officeHour) :
                        ?>
                                <tr>
                                    <?php if ($first) : ?>
                                        <td rowspan="<?= count($officeHours); ?>"><?= htmlspecialchars($day); ?></td>
                                        <?php $first = false; ?>
                                    <?php endif; ?>
                                    <td><?= htmlspecialchars($officeHour['StartTime']); ?></td>
                                    <td><?= htmlspecialchars($officeHour['EndTime']); ?></td>
                                    <td>
                                        <div style="display:flex; gap:10px">
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#editOfficeHoursModal"
                                                data-id="<?php echo $officeHour['OfficeHourID']; ?>"
                                                data-day="<?php echo $officeHour['DayOfWeek']; ?>"
                                                data-start="<?php echo $officeHour['StartTime']; ?>"
                                                data-end="<?php echo $officeHour['EndTime']; ?>">
                                                Edit
                                            </button>
                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-danger " onclick="deleteOfficeHour(<?php echo $officeHour['OfficeHourID']; ?>)">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php if ($index == count($officeHours) - 1) : $first = true;
                                endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div style="display:flex; gap:10px">

                    <button id="downloadpdf" class="btn btn-primary">Download PDF</button>


                    <button id="add-office-hours" class="btn btn-primary" data-toggle="modal" data-target="#addOfficeHoursModal">Add OA</button>

                </div>

            <?php else : ?>
                <p>No office hours available for this professor.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require_once("components/footer.php") ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js"></script>
<script>
    // Handle delete office hour
    // Handle delete office hour
    function deleteOfficeHour(officeHourID) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'actions/delete_OA.php',
                    type: 'POST',
                    data: {
                        officeHourID: officeHourID
                    },
                    dataType: 'json', // Expect JSON response
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Your office hour has been deleted.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload(); // Reload to reflect changes
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message || 'There was an error deleting the office hour.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An unexpected error occurred: ' + error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    }


    // Handle add office hour form submission
    $('#addOfficeHoursForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'actions/add_office_hours.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Office hours added successfully.',
                        icon: 'success',
                        timer: 3000, // Keep the alert visible for 3 seconds (3000ms)
                        showConfirmButton: false // Optionally hide the confirm button
                    }).then(() => {
                        $('#addOfficeHoursModal').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an error adding the office hours.',
                        icon: 'error',
                        timer: 3000, // Optional: Keep the alert visible for 3 seconds
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'An unexpected error occurred: ' + error,
                    icon: 'error',
                    timer: 3000, // Optional: Keep the alert visible for 3 seconds
                    showConfirmButton: false
                });
            }
        });
    });


    // Handle edit office hour form submission
    $('#editOfficeHoursModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var officeHourID = button.data('id');
        var day = button.data('day');
        var start = button.data('start');
        var end = button.data('end');

        var modal = $(this);
        modal.find('#editOfficeHourID').val(officeHourID);
        modal.find('#editDayOfWeek').val(day);
        modal.find('#editStartTime').val(start);
        modal.find('#editEndTime').val(end);
    });

    $('#editOfficeHoursForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'actions/edit_office_hours.php', // Ensure this URL is correct
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json', // Expect JSON response
            success: function(response) {
                console.log(response); // Debug: Check what is being received
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Office hours updated successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#editOfficeHoursModal').modal('hide');
                            location.reload(); // Reload to reflect changes
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'There was an error updating the office hours.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'An unexpected error occurred: ' + error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });


    document.getElementById('downloadpdf').addEventListener('click', function() {
        const element = document.getElementById('officeHoursTable');
        const opt = {
            margin: 1,
            filename: 'professor_schedule.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            }, // Higher scale for better quality
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };

        html2pdf().from(element).set(opt).save();
    });
</script>