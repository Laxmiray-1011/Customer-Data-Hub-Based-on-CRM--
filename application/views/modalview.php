<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Customers</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="<?php echo base_url(); ?>dist/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <style>
        .indent-small {
            margin-left: 5px;
        }

        .form-group.internal {
            margin-bottom: 0;
        }

        .dialog-panel {
            margin: 10px;
        }

        .datepicker-dropdown {
            z-index: 200 !important;
        }

        .panel-body {
            background: #e5e5e5;
            /* Old browsers */
            background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
            /* FF3.6+ */
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
            /* Chrome,Safari4+ */
            background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
            /* Chrome10+,Safari5.1+ */
            background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
            /* Opera 12+ */
            background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
            /* IE10+ */
            background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
            /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
            /* IE6-9 fallback on horizontal gradient */
            font: 600 15px "Open Sans", Arial, sans-serif;
        }

        label.control-label {
            font-weight: 600;
            color: #777;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.multiselect').multiselect();
            $('.datepicker').datepicker();
        });
    </script>

</head>

<body class="sb-nav-fixed">
    <div>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?php echo base_url("index.php/Autocontroller/dashboard"); ?>" style="font-size: 20px;">JAY LAXMI AUTO</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="<?php echo base_url("index.php/Autocontroller/dashboard"); ?>" method="Post">
                <div class="input-group">
                    <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" /> -->
                    <!-- <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button> -->
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li> -->
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="<?php echo base_url("index.php/Autocontroller/logout"); ?>">LOGOUT</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav" style="font-size: 15px;">
                            <div class="sb-sidenav-menu-heading" style="font-size: 10px;">Core</div>
                            <a class="nav-link" href="<?php echo base_url("index.php/Autocontroller/dashboard"); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>



                            <div class="sb-sidenav-menu-heading" style="font-size: 10px;">>Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <!-- <a class="nav-link" href="<?php echo base_url("index.php/Autocontroller/modalview"); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                ModalPage
                            </a> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Jay Laxmi Auto Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>

                    <div class="container-fluid px-4">
                        <h3 class="mt-4">WELCOME TO JAY LAXMI AUTO PARTS</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active" style="font-size: 14px;">Customer View List</li>
                        </ol>
                        <div class="container">
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Customer</button>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style=" font-size: 25px;">Add Customer</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-body">
                                                <div class='panel panel-primary dialog-panel'>
                                                    <div class='panel-heading'>

                                                    </div>
                                                    <div class='panel-body'>
                                                        <form action="#" class='form-horizontal' id="modalbox" role='form' method="POST">

                                                            <div class='form-group'>
                                                                <label class='control-label col-md-2 col-md-offset-2' for='id_title'>Name</label>
                                                                <div class='col-md-8'>
                                                                    <div class='col-md-2'>

                                                                    </div>
                                                                    <div class='col-md-3 indent-small'>
                                                                        <div class='form-group internal'>
                                                                            <input class='form-control' id='name' placeholder='First Name' type='text' style="width:150px;height:50px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class='form-group'>
                                                                <label class='control-label col-md-2 col-md-offset-2' for='id_email'>Contact</label>
                                                                <div class='col-md-6'>
                                                                    <div class='form-group'>
                                                                        <div class='col-md-11'>
                                                                            <input class='form-control' id='email' placeholder='E-mail' type='text'>
                                                                        </div>
                                                                    </div>
                                                                    <div class='form-group internal'>
                                                                        <div class='col-md-11'>
                                                                            <input class='form-control' id='phone' placeholder='Phone: (xxx) - xxx xxxx' type='text'>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label class='control-label col-md-2 col-md-offset-2' for='id_checkin'>Registration Date</label>
                                                                <div class='col-md-8'>
                                                                    <div class='col-md-3'>
                                                                        <div class='form-group internal input-group'>
                                                                            <input class='form-control datepicker' id='checkin' type="date">
                                                                            <!-- <span class='input-group-addon'>
                                                                                <i class='glyphicon glyphicon-calendar'></i>
                                                                            </span> -->
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label class='control-label col-md-2 col-md-offset-2' for='id_comments'>Customer Description</label>
                                                                <div class='col-md-6'>
                                                                    <textarea class='form-control' id='comments' rows='3'></textarea>
                                                                </div>
                                                            </div>


                                                            <div class='form-group'>
                                                                <label class='control-label col-md-2 col-md-offset-2' for='id_comments'>Full
                                                                    Address</label>
                                                                <div class='col-md-6'>
                                                                    <textarea class='form-control' id='address' rows='3'></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                                                <button class='btn-lg btn-primary' type='submit' onclick="save_data()">Save</button>
                                                                <button class='btn-lg btn-danger' style='float:right' type=''>Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                    </br>
                    <div class="card mb-4" style="font-size: 15px;">
                        <div class="card-header" style="font-size: 15px;">
                            <i class="fas fa-table me-1"></i>
                            Customer Data
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" style="font-size: 15px;">
                                <thead>
                                    <tr>
                                        <th>Customer ID</th>
                                        <th>Customer name</th>
                                        <th>Phone no.</th>
                                        <th>Email</th>
                                        <th>Description</th>
                                        <th>Address</th>
                                        <th>Bill Due</th>
                                        <th>ADD PAYMENTS</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Cusid</th>
                                        <th>Customer name</th>
                                        <th>Phone no.</th>
                                        <th>Email</th>
                                        <th>Description</th>
                                        <th>Address</th>
                                        <th>Bill Due</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
            </div>
            </main>
        </div>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>dist/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>dist/assets/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url(); ?>dist/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>dist/js/datatables-simple-demo.js"></script>

    <script type="text/javascript">
        function save_data() {

            $(document).on("submit", "#modalbox", function(event) {
                event.preventDefault();
                var name = $("#name").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var description = $("#comments").val();
                var address = $("#address").val();
                var regdate = $("#checkin").val();

                if (name == '') {
                alert("Fill The Customer Name Field!");
                return false;
            }


                // $.ajax({
                //     url: "<?php echo base_url('Autocontroller/ajax_add'); ?>",
                //     method: 'POST',
                //     success: function(data) {
                //         alert(data);
                //         $("#myModal").modal("hide");
                //     }
                // });


            });
        }
        // $(document).on("submit", "#modalbox", function(event) {
        //     event.preventDefault();
        //     var name = $("#name").val();
        //     var email = $("#email").val();
        //     var phone = $("#phone").val();
        //     var description = $("#comments").val();
        //     var address = $("#address").val();
        //     var regdate = $("#checkin").val();

        //     $.ajax({
        //         url: "<?php echo base_url('index.php/Autocontroller/ajax_add'); ?>",
        //         method: 'POST',
        //         success: function(data) {
        //             alert(data);
        //             $("#myModal").modal("hide");
        //         }
        //     });

        // });
    </script>

    </div>




</body>

</html>