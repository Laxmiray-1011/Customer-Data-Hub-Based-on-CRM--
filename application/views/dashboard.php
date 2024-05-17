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
                            <a class="nav-link" href="<?php echo base_url("index.php/Autocontroller/modalview"); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                ModalPage
                            </a>
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
                        <h1 class="mt-4">WELCOME TO JAY LAXMI AUTO PARTS</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active" style="font-size: 14px;">Customer View List</li>
                        </ol>



                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4" style="font-size: 15px;">

                                    <div class="card-body" id="customer" type="button">Add Customer</div>


                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?php echo site_url('Autocontroller/register') ?>"></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            

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
                                        <?php
                                        $sl = 1;
                                        foreach ($contentdata as $show) {
                                            // echo "<pre>";
                                            //      print_r($show);


                                        ?>
                                            <tr>
                                                <td><?php echo $sl;
                                                    $sl++  ?></td>
                                                <td><?php echo $show->c_name; ?></td>
                                                <td><?php echo $show->c_phone; ?></td>
                                                <td><?php echo $show->c_email; ?></td>
                                                <td><?php echo $show->c_desc; ?></td>
                                                <td><?php echo $show->c_addr; ?></td>
                                                <td><?php echo $show->c_regdate; ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" style="width:80px;" href="customer_paymentview_list?pay=<?php echo $show->c_id ?>"> <i class="glyphicon glyphicon-plus" style="font-size:15px;">Add</i></a>
                                                </td>

                                                <td><a class="btn btn-sm btn-primary" style="width:80px;" href="updatedata?ep=<?php echo $show->c_id ?>"> <i class="glyphicon glyphicon-pencil" style="font-size:15px;"> Edit</i></a>
                                                    <a class="btn btn-sm btn-danger" style="width:80px;"  href="deletedata?del=<?php echo $show->c_id ?>"> <i class="glyphicon glyphicon-trash" style="font-size:15px;"> Delete</i></a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                </main>
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
    </div>
</body>