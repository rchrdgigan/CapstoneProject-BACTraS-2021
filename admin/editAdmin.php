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
        <title>Edit Citizen Info</title>
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
                                    <h3>Edit info for Admin</h3>
                                </div>
                                <div class="module-body">

                                    <?php
                                    if(isset($_GET['edit_admin'])){
                                        $edit_admin = $_GET['edit_admin'];
                                        $displayAdmin = New Admin();
                                        $displayAdmin -> displayAdmintext($edit_admin);
                                        if (isset($_POST['submit'])) {
                                            date_default_timezone_set("Asia/Manila");
                                            $createAt = Date('Y-m-d H:i:sa');
                                            $id = $_GET['edit_admin'];
                                            $fname = $_POST['fname'];
                                            $mname = $_POST['mname'];
                                            $lname = $_POST['lname'];
                                            $email = $_POST['email'];
                                            $address = $_POST['address'];
                                            $cpnumber = $_POST['cpnumber'];
                                            $username = $_POST['username'];
                                            $password = $_POST['password'];
                                            $role = "Admin";                                  
                                            $updateAdmin = New Admin();
                                            $updateAdmin -> updateAdmin($fname, $mname, $lname, $email, $cpnumber,$username, $password, $role, $createAt, $id);
                                        }
                                    }
                                    ?>
                                    
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