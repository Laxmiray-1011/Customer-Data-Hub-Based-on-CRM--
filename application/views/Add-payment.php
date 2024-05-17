<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ADD-PAYMENTS</title>
    <link href="<?php echo base_url(); ?>css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




    <script>
        $("document").ready(function() {
            $("#billdate").datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true,
            });

        })
    </script>

</head>

<body class="bg-primary">
    <h1 style="font-size:15pt;color:white" id="header">Hi <?php echo $customer_name; ?>&nbsp;</h1>
    <h4> <span class="btn btn-primary" style="font-size: 18px;" id="billamount_sum">Total Bill AmountIs Rs.<?php echo $billamount_sum; ?>&nbsp;</span>&nbsp;
        <span class="btn btn-primary" style="font-size: 18px;" id="totalpayment_sum">Total Paid Amount Is Rs.<?php echo $totalpayment_sum; ?>&nbsp;</span>&nbsp;
        <span class="btn btn-primary" style="font-size: 18px;" id="totalbilldue">Total Remaining Balance Is Rs.<?php echo $lastbilldue; ?>&nbsp;</span>&nbsp;
    </h4>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Add Payments</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?php echo base_url("index.php/Autocontroller/paymentform_submit"); ?>">
                                        <input id="customer_id" name="customer_id" type="hidden" value="<?php echo $customer_id ?>" />

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="lastbilldueadd" name="lastbilldueadd" type="text" placeholder="Enter Previous Due" value="<?php echo $lastbilldue,
                                                                                                                                                                                set_value("lastbilldueadd") ?>" />
                                                    <?php echo form_error('lastbilldueadd.', '<div class="error">', '</div>') ?>
                                                    <label for="lastbilldueadd">Previous Due</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="billdate" name="billdate" type="text" class="form-control datepicker" value="<?php echo set_value("billdate") ?>" />
                                                    <?php echo form_error('billdate', '<div class="error">', '</div>') ?>
                                                    <label for="billdate">Bill Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="billnumber" name="billnumber" type="text" placeholder="name@example.com" value="<?php echo set_value("billnumber") ?>" />
                                            <?php echo form_error('billnumber', '<div class="error">', '</div>')  ?>
                                            <label for="billnumber">Bill Number</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" onblur="addbilldue()" id="billamountadd" name="billamountadd" type="text" placeholder="Customer description" value="<?php echo set_value("billamountadd") ?>" />
                                            <?php echo form_error('billamountadd', '<div class="error">', '</div>') ?>
                                            <label for="billamountadd">Bill Amount</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" onblur="addbilldue()" id="totalpaymentadd" name="totalpaymentadd" type="text" placeholder="Please enter address" value="<?php echo set_value("totalpaymentadd") ?>" />
                                            <?php echo form_error('totalpaymentadd', '<div class="error">', '</div>') ?>
                                            <label for="totalpaymentadd">Total Payments</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="billdescription" name="billdescription" type="text" placeholder="Please enter address" value="<?php echo set_value("billdescription") ?>">
                                             </textarea>
                                            <?php echo form_error('billdescription', '<div class="error">', '</div>') ?>
                                            <label for="billdescription">Bill Description</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="billdueadd" name="billdueadd" type="text" placeholder="Please enter address" value="<?php echo set_value("billdueadd") ?>" />
                                            <?php echo form_error('billdueadd', '<div class="error">', '</div>') ?>
                                            <label for="billdueadd">Balance Due</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="balancedueadd" name="balancedueadd" type="text" placeholder="Please enter address" value="<?php echo set_value("balancedueadd") ?>" />
                                            <?php echo form_error('balancedueadd', '<div class="error">', '</div>') ?>
                                            <label for="balancedueadd">Total Due</label>
                                        </div>

                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><input class="btn btn-primary btn-block" type="submit" name="submit" value="SAVE"></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="<?php echo base_url("index.php/Autocontroller/customer_paymentview_list?pay=".$customer_id); ?>" class="btn btn-sm btn-danger">CANCEL</a></div>
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



    <script type="text/javascript">
        
        function addbilldue(customer_id) {


            var billamountadd = document.getElementById("billamountadd").value;
            var totalpaymentadd = document.getElementById("totalpaymentadd").value;
            var lastbilldueadd = document.getElementById("lastbilldueadd").value;
            var balancedueadd = document.getElementById("balancedueadd").value;


            if (totalpaymentadd == '') {
                var sum = parseInt(billamountadd) + parseInt(lastbilldueadd);
                //var total = parseInt(sum) - parseInt(totalpaymentadd) ;
                document.getElementById('balancedueadd').value = sum;

            }

            if (billamountadd == '') {
                //var sum = parseInt(totalpaymentadd) + parseInt(lastbilldueadd);	

                var sum = parseInt(lastbilldueadd) - parseInt(totalpaymentadd);
                //var total = parseInt(sum) - parseInt(totalpaymentadd) ;
                document.getElementById('balancedueadd').value = sum;

            }
            if ((billamountadd == '') && (totalpaymentadd == '')) {
                //var sum = parseInt(totalpaymentadd) + parseInt(lastbilldueadd);	
                //var total = parseInt(sum) - parseInt(totalpaymentadd) ;
                document.getElementById('balancedueadd').value = lastbilldueadd;



            }

            if ((billamountadd != '') && (totalpaymentadd != '')) {
                var sum = parseInt(billamountadd) + parseInt(lastbilldueadd);
                var total = parseInt(sum) - parseInt(totalpaymentadd);
                document.getElementById('balancedueadd').value = total;


                var sum = parseInt(billamountadd);
                var total = parseInt(sum) - parseInt(totalpaymentadd);
                document.getElementById('billdueadd').value = total;
            }

        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>js/scripts.js"></script>
</body>

</html>