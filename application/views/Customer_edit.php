<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Customer_Register</title>
    <link href="<?php echo base_url(); ?>css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Add Customer</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    foreach ($contentdata as $result) {
                                    ?>
                                        <form method="POST">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputName" name="Name" type="text" placeholder="Enter your  name" value="<?php echo $result->c_name ?>" />
                                                        <?php echo form_error('Name', '<div class="error">', '</div>') ?>
                                                        <label for="inputName">Customer name</label>

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="phone" name="phone" type="Number" placeholder="Enter your phone number" value="<?php echo $result->c_phone?>" />
                                                        <?php echo form_error('phone', '<div class="error">', '</div>') ?>
                                                        <label for="inputphone">Phone Number</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" value="<?php echo $result->c_email ?>" />
                                                <?php echo form_error('email', '<div class="error">', '</div>') ?>
                                                <label for="inputEmail">Email address</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="description" type="textarea" name="description" placeholder="Customer description" value="<?php echo $result->c_desc ?>" />
                                                <?php echo form_error('description', '<div class="error">', '</div>') ?>
                                                <label for="inputdescription">Customer Description</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="address" type="textarea" name="address" placeholder="Please enter address" value="<?php echo $result->c_addr ?>" />
                                                <?php echo form_error('address', '<div class="error">', '</div>') ?>
                                                <label for="inputaddress">Full address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="date" type="date" name="date" placeholder="Please enter registration date" value="<?php echo $result->c_regdate ?>" />
                                                <?php echo form_error('date', '<div class="error">', '</div>') ?>
                                                <label for="inputdate">Registration Date</label>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><input class="btn btn-primary btn-block" type="submit" name="submit" value=" EDIT DATA"></div>
                                            </div>
                                        </form>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a class="btn btn-sm btn-danger" href="<?php echo site_url('Autocontroller/dashboard') ?>" >If you don't want to Edit, Go to Dashboard Page</a></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
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
    <script src="<?php echo base_url(); ?>js/scripts.js"></script>
</body>

</html>