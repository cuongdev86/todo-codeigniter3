<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/admins/form-login/css/style.css">

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

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        <div class="img" style="background-image: url(<?= base_url() ?>assets/admins/form-login/images/bg-1.jpg);"></div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign In</h3>
                                </div>
                                <!-- <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div> -->
                            </div>
                            <form action="<?= base_url() ?>postlogin" class="signin-form" method="post">
                                <div class="form-group mt-3">
                                    <input type="text" name="username" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">Username</label>
                                </div>
                                <div class="form-group">
                                    <input id="password-field" name="password" type="password" class="form-control" required>
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input type="checkbox" checked name="remember">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <!-- <div class="w-50 text-md-right">
                                        <a href="#">Forgot Password</a>
                                    </div> -->
                                </div>
                            </form>
                            <!-- <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= base_url(); ?>assets/admins/form-login/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/admins/form-login/js/popper.js"></script>
    <script src="<?= base_url(); ?>assets/admins/form-login/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/admins/form-login/js/main.js"></script>

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

</body>

</html>