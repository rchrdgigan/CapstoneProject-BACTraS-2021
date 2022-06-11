<?php           
    include('../classes/dbcon.class.php');
    include('../classes/admin.class.php');
    $authenAdmin = New Admin();
    $authenAdmin->authAdmin(); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Admin User</title>
        <?php include('../includes/layout/admin/adminsrclink.inc.php'); ?>
        <link href="../assets/css/sweetalert.css" rel="stylesheet">
    </head>
    <body>
        <?php include('../includes/layout/admin/adminnav.inc.php'); ?>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php include('../includes/layout/admin/adminsidebar.inc.php'); ?>
                    <div class="span9">
                        <div class="content">
                            <div class="module">
                                <div class="module-head">
                                    <h3>Registration for Admin</h3>
                                </div>
                                <div class="module-body">
                                    <?php
                                        if (isset($_POST['submit'])) {
                                            $fname = $_POST['fname'];
                                            $mname = $_POST['mname'];
                                            $lname = $_POST['lname'];
                                            $email = $_POST['email'];
                                            $address = $_POST['address'];
                                            $cpnumber = $_POST['cpnumber'];
                                            $username = $_POST['username'];
                                            $password = $_POST['password'];
                                            $role = "Admin";                                  
                                            $insertAdmin = New Admin();
                                            $insertAdmin -> insertAdmin($fname, $mname, $lname, $email, $cpnumber,$username, $password, $role);
                                        }
                                    ?>
                                    <form class="form-horizontal row-fluid" method="POST" action="">
                                        <div class="control-group">
                                            <label class="control-label" for="First">First Name</label>
                                            <div class="controls">
                                                <input type="text" id="First" name="fname" placeholder="Enter First Name" class="span8" required="">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Middle">Middle Name</label>
                                            <div class="controls">
                                                <input type="text" id="Middle" name="mname" placeholder="Enter Middle Name" class="span8" required="">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Last">Last Name</label>
                                            <div class="controls">
                                                <input type="text" id="Last" name="lname" placeholder="Enter Last Name" class="span8" required="">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Email">Email Address</label>
                                            <div class="controls">
                                                <input type="email" id="Email" name="email" placeholder="Enter Email" class="span8" required="">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="contact1">Cellphone</label>
                                            <div class="controls">
                                                <input id="contact1" name="cpnumber" type="text" onchange="valnumblenght();" onkeypress="isInputNumber(event);" placeholder="09XXXXXXXXX" class="span8" required="">
                                                <span class="help-inline"><label id="lbltxt" class="text-danger"></label></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="username">Username</label>
                                            <div class="controls">
                                                <input id="username" type="text" name="username" placeholder="Enter Username" class="span8" required="">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="pass">Password</label>
                                            <div class="controls">
                                                <input id="pass" type="password" name="password" placeholder="Enter Password" class="span8"  required="">
                                            </div>
                                            <div class="controls">
                                                <label class="checkbox">
                                                    <input type="checkbox" value="" onclick="showPass();">
                                                    Show Password
                                                </label>
                                            </div>
                                            <div class="controls">
                                                <label for="pass" class="" for="basicinput">--Password must contained 6 character!</label>
                                            </div>
                                            <div class="controls">
                                                <label for="pass" class="" for="basicinput">--Password must be less than 20 character!</label>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button name="submit" type="Submit" class="btn btn-primary">Submit Form</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <?php include('../includes/layout/main/footer.inc.php'); ?>
        <script src="../assets/js/sweetalert-dev.js" defer></script>
        <script src="../assets/js/formvalidation.js" defer></script>
    </body>
</html>