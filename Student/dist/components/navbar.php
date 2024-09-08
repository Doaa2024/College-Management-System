<body class="">
    <div class="page">
        <div class="page-main">
            <div class="header py-4">
                <div class="container">
                    <div class="d-flex">
                        <a class="header-brand" href="./index.html">
                            <img src="./demo/brand/tabler.svg" class="header-brand-img" alt="tabler logo">
                        </a>
                        <div class="d-flex order-lg-2 ml-auto">

                            <div class="dropdown d-none d-md-flex">
                                <a class="nav-link icon" data-toggle="dropdown">
                                    <i class="fe fe-bell"></i>
                                    <span class="nav-unread"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a href="#" class="dropdown-item d-flex">
                                        <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span>
                                        <div>
                                            <strong>Nathan</strong> pushed new commit: Fix page load performance issue.
                                            <div class="small text-muted">10 minutes ago</div>
                                        </div>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                </div>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                    <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>
                                    <span class="ml-2 d-none d-lg-block">
                                        <span class="text-default">Jane Pearson</span>
                                        <small class="text-muted d-block mt-1">Administrator</small>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="#">
                                        <i class="dropdown-icon fe fe-user"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="dropdown-icon fe fe-settings"></i> Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">
                                        <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="dropdown-icon fe fe-log-out"></i> Sign out
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                            <span class="header-toggler-icon"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg order-lg-first">
                            <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                                <?php
                                $current_page = basename($_SERVER['PHP_SELF']); // Get the current page filename
                                ?>
                                <li class="nav-item ">
                                    <a href="./index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>"><i class="fe fe-home"></i> Home</a>
                                </li>
                                <li class="nav-item ">
                                    <a href="./classes.php" class="nav-link <?php echo $current_page == 'classes.php' ? 'active' : ''; ?>"><i class="fe fe-box"></i> Classes</a>
                                </li>
                                <li class="nav-item ">
                                    <a href="./payments.php " class="nav-link <?php echo $current_page == 'payments.php' ? 'active' : ''; ?>"><i class="fa fa-credit-card"></i> Payments</a>
                                </li>
                                <li class="nav-item dropdown ">
                                    <a href="./pof.php" class="nav-link <?php echo $current_page == 'pof.php' ? 'active' : ''; ?>"><i class="fe fe-file-text"></i> Plan of Study</a>
                                </li>
                                <li class="nav-item">
                                    <a href="./registration.php " class="nav-link <?php echo $current_page == 'registration.php' ? 'active' : ''; ?>"><i class="fe fe-calendar"></i> Registration</a>
                                </li>
                                <li class="nav-item ">
                                    <a href="./os.php" class="nav-link <?php echo $current_page == 'os.php' ? 'active' : ''; ?>"><i class="fe fe-file-text"></i> Online Services</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>