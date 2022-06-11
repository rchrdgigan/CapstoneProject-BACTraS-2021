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
        <title>Registered Citizen</title>
        <?php include('../includes/layout/admin/adminsrclink.inc.php'); ?>
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
                            <!--/.module-->
                            <div class="module">
                                <div class="module-head">
                                    <h3>Deativated Establishment Account</h3>
                                </div>
                                <div class="module-body table">
                                    <?php
                                    //Post Deactivated Account!
                                        $getdeactivatedCitizen = New Admin();
                                        $getdeactivatedCitizen->getdeactivateEstablishment();  
                                        if(isset($_GET['active_estab'])){
                                        $active_estab = $_GET['active_estab'];
                                        $activeEstablish = New Admin();
                                        $activeEstablish->activeEstablish($active_estab);
                                            if($active_estab){
                                                echo "<script>alert('Account has been activated...');</script>";
                                            echo "<meta http-equiv='refresh' content='0, url=datatableEstablishment.php'>"; 
                                            }else{
                                                echo "Failed to activated..."; 
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <!--/.module-->
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
    </body>
