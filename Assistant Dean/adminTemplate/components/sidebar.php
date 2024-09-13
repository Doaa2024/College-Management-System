<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Assistant Dean</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Courses
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages4"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-calendar-check" style="color: white;"></i>

                    <span style="color:white;">Department Schedule</span>
                </a>
                <div id="collapsePages4" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <?php
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    ?>
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php if ($currentPage == 'courses_control.php') echo 'page_selected'; ?>" href="courses_control.php">
                            <i class="fas fa-clock"></i>
                            Time Control</a>
                        <a class="collapse-item <?php if ($currentPage == 'schedule.php') echo 'page_selected'; ?>" href="schedule.php">
                            <i class="fas fa-calendar-day"></i>
                            Weekly Schedule</a>
                        <a class="collapse-item <?php if ($currentPage == 'calender_courses.php') echo 'page_selected'; ?>" href="calender_courses.php">
                            <i class="fas fa-calendar-check"></i>

                            Events </a>
                    </div>
                </div>
            </li>
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

            <!-- Nav Item - Pages Collapse Menu -->


            <style>
                .page_selected {
                    background-color: #d1ecf1;
                    /* Light blue background */
                }
            </style>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading">
                NewsLetter
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-paper-plane" style="color:white;"></i>
                    <span style="color:white;"> News Letter</span>
                </a>
                <div id="collapsePages3" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <?php
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    ?>
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php if ($currentPage == 'pnl.php') echo 'page_selected'; ?>" href="pnl.php">
                            <i class="fas fa-share-square"></i> Publish News Letter</a>
                        <a class="collapse-item <?php if ($currentPage == 'vnl.php') echo 'page_selected'; ?>" href="vnl.php?branchId">
                            <i class="fas fa-eye"></i> View News Letters</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <script>
            document.getElementById('sidebarToggle').addEventListener('click', function() {
                document.getElementById('accordionSidebar').classList.toggle('toggled');
            });
        </script>