<?php
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(2);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admins/css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admins/css/feather.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admins/css/dataTables.bootstrap4.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admins/css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admins/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admins/css/app-dark.css" id="darkTheme" disabled>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admins/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admins/css/toastr.min.css">
    <script src="<?= base_url(); ?>assets/admins/library/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admins/library/sweetalert2/dist/sweetalert2.min.css">



    <script src="<?= base_url(); ?>assets/admins/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/admins/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/admins/js/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/admins/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/admins/js/simplebar.min.js"></script>
    <script src="<?= base_url(); ?>assets/admins/js/daterangepicker.js"></script>
    <script src="<?= base_url(); ?>assets/admins/js/jquery.stickOnScroll.js"></script>
    <script src="<?= base_url(); ?>assets/admins/js/tinycolor-min.js"></script>

</head>

<body class="vertical  light  ">
    <div class="wrapper">
        <nav class="topnav navbar navbar-light">
            <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
                <i class="fe fe-menu navbar-toggler-icon"></i>
            </button>
            <form class="form-inline mr-auto searchform text-muted">
                <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
            </form>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                        <i class="fe fe-sun fe-16"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
                        <span class="fe fe-grid fe-16"></span>
                    </a>
                </li>
                <li class="nav-item nav-notif">
                    <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
                        <span class="fe fe-bell fe-16"></span>
                        <span class="dot dot-md bg-success"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="avatar avatar-sm mt-2">
                            <img src="<?= base_url() ?>assets/admins/assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activities</a>
                    </div>
                </li>
            </ul>
        </nav>
        <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
            <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
                <i class="fe fe-x"><span class="sr-only"></span></i>
            </a>
            <nav class="vertnav navbar navbar-light">
                <!-- nav bar -->
                <div class="w-100 mb-4 d-flex">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="<?= base_url() ?>">
                        <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                            <g>
                                <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                                <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                                <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                            </g>
                        </svg>
                    </a>
                </div>


                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item w-100 <?= $segment1 == 'works' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url() ?>works">
                            <i class="fe fe-calendar fe-16"></i>
                            <span class="ml-3 item-text">Works</span>
                        </a>
                    </li>
                    <li class="nav-item w-100 <?= $segment1 == 'users' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url() ?>users">
                            <i class="fe fe-users fe-16"></i>
                            <span class="ml-3 item-text">Users</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <?= $content; ?>
            </div> <!-- .container-fluid -->
            <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="list-group list-group-flush my-n3">
                                <div class="list-group-item bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="fe fe-box fe-24"></span>
                                        </div>
                                        <div class="col">
                                            <small><strong>Package has uploaded successfull</strong></small>
                                            <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                                            <small class="badge badge-pill badge-light text-muted">1m ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="fe fe-download fe-24"></span>
                                        </div>
                                        <div class="col">
                                            <small><strong>Widgets are updated successfull</strong></small>
                                            <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                                            <small class="badge badge-pill badge-light text-muted">2m ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="fe fe-inbox fe-24"></span>
                                        </div>
                                        <div class="col">
                                            <small><strong>Notifications have been sent</strong></small>
                                            <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                                            <small class="badge badge-pill badge-light text-muted">30m ago</small>
                                        </div>
                                    </div> <!-- / .row -->
                                </div>
                                <div class="list-group-item bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="fe fe-link fe-24"></span>
                                        </div>
                                        <div class="col">
                                            <small><strong>Link was attached to menu</strong></small>
                                            <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                                            <small class="badge badge-pill badge-light text-muted">1h ago</small>
                                        </div>
                                    </div>
                                </div> <!-- / .row -->
                            </div> <!-- / .list-group -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body px-5">
                            <div class="row align-items-center">
                                <div class="col-6 text-center">
                                    <div class="squircle bg-success justify-content-center">
                                        <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Control area</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Activity</p>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Droplet</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Upload</p>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-users fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Users</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Settings</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main> <!-- main -->
    </div> <!-- .wrapper -->

    <script src="<?= base_url(); ?>assets/admins/js/config.js"></script>
    <script src="<?= base_url(); ?>assets/admins/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/admins/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/admins/js/toastr.min.js"></script>
    <script>
        $(function() {
            <?php if ($this->session->flashdata('message') && $this->session->flashdata('message_type')) : ?>
                toastr.<?= $this->session->flashdata('message_type') ?>('<?= $this->session->flashdata('message') ?>');
            <?php endif; ?>
        });
    </script>
    <script>
        // $('#dataTable-1').DataTable({
        //     autoWidth: true,
        //     "lengthMenu": [
        //         [16, 32, 64, -1],
        //         [16, 32, 64, "All"]
        //     ]
        // });
    </script>
    <script src="<?= base_url(); ?>assets/admins/js/apps.js"></script>
</body>

</html>