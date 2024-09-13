<?php require_once("header.php"); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Begin Modal for Password -->
    <div class="modal fade" id="editPassword2" tabindex="-1" role="dialog" aria-labelledby="editPasswordLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPasswordLabel">Edit Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="editPasswordForm2">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input class="form-control" id="confirm_password" name="confirm_password">
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
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>
                        </span>
                        <img class="img-profile rounded-circle"
                            src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editPassword2">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="http://localhost/mosque-website-template/President/adminTemplate/login.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->
        <?php require_once("scripts.php"); ?>
        <script>
            $(document).ready(function() {
                $('#editPasswordForm2').on('submit', function(e) {
                    e.preventDefault();

                    var password = $('#password').val();
                    var confirmPassword = $('#confirm_password').val();


                    // Password match validation
                    if (password !== confirmPassword) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Passwords do not match. Please try again.',
                            showConfirmButton: true
                        });
                        return;
                    }

                    // Password validation pattern
                    var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;


                    if (!passwordPattern.test(password)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Password must be at least 8 characters long and include a mix of uppercase, lowercase, numbers, and special characters.',
                            showConfirmButton: true
                        });
                        return;
                    }

                    // Send AJAX request
                    $.ajax({
                        url: 'actions/update_Assistantdean_password.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'json',
                        processData: false,
                        success: function(response) {
                            console.log('Response:', response); // Debugging line
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message || 'Password updated successfully.',
                                    showConfirmButton: true
                                }).then(function() {
                                    $('#editPassword2').modal('hide');
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message || 'Failed to update password. Please try again.',
                                    showConfirmButton: true
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('AJAX Error:', textStatus, errorThrown); // Debugging line
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'An error occurred. Please try again.',
                                showConfirmButton: true
                            });
                        }
                    });

                });
            });
        </script>