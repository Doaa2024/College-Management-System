<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-clipboard"></i>


                </div>
                <div class="sidebar-brand-text mx-3">Secretary</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">

                    <i class="fas fa-question-circle fa-2x text-gray-300"></i>

                    <span>Pages Inquires</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">

                    <style>
                        .page_selected {
                            background-color: #d1ecf1;
                            /* Light blue background */
                        }
                    </style>

                    <div class="bg-white py-2 collapse-inner rounded">
                        <?php
                        $currentPage = basename($_SERVER['PHP_SELF']);
                        ?>
                        <a class="collapse-item <?php if ($currentPage == 'requirements.php') echo 'page_selected'; ?>" href="requirements.php">
                            <i class="fas fa-file-alt"></i> Requirements
                        </a>
                        <a class="collapse-item <?php if ($currentPage == 'freshman.php') echo 'page_selected'; ?>" href="freshman.php">
                            <i class="fas fa-user-graduate"></i> Freshman
                        </a>
                        <a class="collapse-item <?php if ($currentPage == 'transfer.php') echo 'page_selected'; ?>" href="transfer.php">
                            <i class="fas fa-exchange-alt"></i> Transfer
                        </a>
                        <a class="collapse-item <?php if ($currentPage == 'schools.php') echo 'page_selected'; ?>" href="schools.php">
                            <i class="fas fa-school"></i> Schools
                        </a>
                    </div>


                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Job Review
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-city"></i>
                    <span>Branches</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="tripoli.html">
                            <i class="fas fa-building mr-2"></i> Tripoli
                        </a>
                        <a class="collapse-item" href="branch.html">
                            <i class="fas fa-building mr-2"></i> Tyre
                        </a>
                        <a class="collapse-item" href="branch.html">
                            <i class="fas fa-building mr-2"></i> Khiara
                        </a>
                        <a class="collapse-item" href="branch.html">
                            <i class="fas fa-building mr-2"></i> Saida
                        </a>
                        <a class="collapse-item" href="branch.html">
                            <i class="fas fa-building mr-2"></i> Beirut
                        </a>

                    </div>
                </div>
            </li> -->
            <li class="nav-item active">
                <a class="nav-link" href="jobs.php">
                    <i class="fas fa-briefcase"></i>

                    <span>Job offers</span>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Faculties</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="engineering.html"> <i class="fas fa-tree mr-2"></i> Faculty of Engineering</a>
                        <a class="collapse-item" href="medicine.html"> <i class="fas fa-tree mr-2"></i> Faculty of Medicine</a>
                        <a class="collapse-item" href="business.html"> <i class="fas fa-tree mr-2"></i> Faculty of Business</a>
                        <a class="collapse-item" href="arts.html"> <i class="fas fa-tree mr-2"></i> Faculty of Arts</a>
                        <a class="collapse-item" href="science.html"> <i class="fas fa-tree mr-2"></i> Faculty of Science</a>
                        <a class="collapse-item" href="law.html"> <i class="fas fa-tree mr-2"></i> Faculty of Law</a>
                        <a class="collapse-item" href="education.html"> <i class="fas fa-tree mr-2"></i> Faculty of Education</a>

                    </div>
                </div>
            </li> -->

            <!-- Nav Item - Utilities Collapse Menu -->


            <!-- Divider -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Human Resources
            </div>
            <li class="nav-item active">
                <a class="nav-link" href="Student.php">
                    <i class="fas fa-fw fa-search"></i>
                    <span> Search Students</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="employee.php">
                    <i class="fas fa-fw fa-search"></i>
                    <span>Search Employees</span>
                </a>
            </li>
            <li class="nav-item">
                <a style="color:white;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-file-alt" style="color:white;"></i>


                    <span>Applications</span>
                </a>
                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">

                    <style>
                        .page_selected {
                            background-color: #d1ecf1;
                            /* Light blue background */
                        }
                    </style>

                    <div class="bg-white py-2 collapse-inner rounded">
                        <?php
                        $currentPage = basename($_SERVER['PHP_SELF']);
                        ?>
                        <a class="collapse-item <?php if ($currentPage == 'student_apply.php') echo 'page_selected'; ?>" href="student_apply.php" target="_blank">
                            <i class="fas fa-user-graduate"></i>
                            </i> Apply for Student
                        </a>
                        <a class="collapse-item <?php if ($currentPage == 'student_applications.php') echo 'page_selected'; ?>" href="student_applications.php">
                            <i class="fas fa-file-alt"></i>

                            Student Applications
                        </a>
                        <a class="collapse-item <?php if ($currentPage == 'employee_applications.php') echo 'page_selected'; ?>" href="employee_applications.php">
                            <i class="fas fa-briefcase"></i>
                            Employee Applications
                        </a>
                    </div>


                </div>
            </li>
            <li class="nav-item">
                <a style="color:white;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-user-plus" style="color:white;"></i>



                    <span>Registration</span>
                </a>
                <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">

                    <style>
                        .page_selected {
                            background-color: #d1ecf1;
                            /* Light blue background */
                        }
                    </style>

                    <div class="bg-white py-2 collapse-inner rounded">
                        <?php
                        $currentPage = basename($_SERVER['PHP_SELF']);
                        ?>
                        <a class="collapse-item <?php if ($currentPage == 'student_registered.php') echo 'page_selected'; ?>" href="student_registered.php" target="_blank">
                            <i class="fas fa-user-check"></i>

                            </i> Registered Student
                        </a>
                        <a class="collapse-item <?php if ($currentPage == 'employee_registered.php') echo 'page_selected'; ?>" href="employee_registered.php">
                            <i class="fas fa-user-tie"></i>


                            Employees
                        </a>
                    </div>


                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading">
                NewsLetter
            </div>
            <li class="nav-item active">
                <a class="nav-link" href="Student.php">
                    <i class="fas fa-fw fa-paper-plane"></i>


                    <span> NewsLetters</span>
                </a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->