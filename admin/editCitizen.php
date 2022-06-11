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
                                    <h3>Edit info for Citizen</h3>
                                </div>
                                <div class="module-body">

                                    <?php
                                    if(isset($_GET['edit_citizen'])){
                                        $edit_citizen = $_GET['edit_citizen'];
                                        $displayCitizentext = New Admin();
                                        $displayCitizentext -> displayCitizentext($edit_citizen);
                                        if (isset($_POST['submit'])) {
                                            date_default_timezone_set("Asia/Manila");
                                            $createAt = Date('Y-m-d H:i:sa');
                                            $edit_citizen = $_GET['edit_citizen'];
                                            $suffix = $_POST['suffix'];
                                            $fname = $_POST['fname'];
                                            $mname = $_POST['mname'];
                                            $lname = $_POST['lname'];
                                            $bdate = $_POST['bdate'];
                                            $address = $_POST['address'];
                                            $gender = $_POST['gender'];
                                            if($_POST['Male'] == 'Male'){
                                                $gender = $_POST['Male'];
                                            }else{
                                                $gender = $_POST['Female'];
                                            }
                                            $cpnumber = $_POST['cpnumber'];
                                            $username = $_POST['username'];
                                            $hashpassword = $_POST['password'];
                                            $password = password_hash($hashpassword, PASSWORD_DEFAULT);
                                            $role = "Person";
                                            $emailAddress = $_POST['emailAddress'];                                  
                                            $updateCitizen = New Admin();
                                            $updateCitizen -> updateCitizen($fname, $mname, $lname, $suffix, $bdate, $gender, $cpnumber, $address, $username, $password, $role, $emailAddress, $createAt, $edit_citizen);
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