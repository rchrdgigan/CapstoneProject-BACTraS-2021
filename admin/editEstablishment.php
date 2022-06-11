<?php           
    include('../classes/dbcon.class.php');
    include('../classes/admin.class.php');
    $authenAdmin = New Admin();
    $authenAdmin->authAdmin(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Establisment Info</title>
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
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="module">
                            <div class="module-head">
                                <h3>Edit for Establisment</h3>
                            </div>
                            <div class="module-body">
                                <?php
                                    if(isset($_GET['edit_estab'])){
                                        $estab_id = $_GET['edit_estab'];
                                        $showEstab = New Admin();
                                        $showEstab->showEstablishmenttext($estab_id);
                                    }
                                    if (isset($_POST['submit'])) {
                                        date_default_timezone_set("Asia/Manila");
                                        $createAt = Date('Y-m-d H:i:sa');
                                        $estab_id = $_GET['edit_estab'];
                                        $bname = $_POST['bname'];
                                        $baddress = $_POST['baddress'];
                                        $cperson = $_POST['cperson'];
                                        $emailadd = $_POST['emailadd'];
                                        $cpnumber = $_POST['cpnumber'];
                                        $username = $_POST['username'];
                                        $password = $_POST['password'];
                                        $role = "Merchant";
                                        $updateEstablishment = new Admin();
                                        $updateEstablishment->updateEstablishment($bname, $baddress, $cperson, $emailadd, $cpnumber,$username,$password,$role, $createAt, $estab_id);
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