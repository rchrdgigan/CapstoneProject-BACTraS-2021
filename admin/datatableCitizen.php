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
                                    <h3>Registered Citizen Table</h3>
                                </div>
                                <div class="module-body table">
                                    <?php
                                        $datatabeCitizen = New Admin();
                                        $datatabeCitizen->getCitizen();  
                                        if(isset($_GET['deativate_citizen'])){
                                        $deativate_citizen = $_GET['deativate_citizen'];
                                        $deativateCitizen = New Admin();
                                        $deativateCitizen->deativateCitizen($deativate_citizen);
                                            if($deativate_citizen){
                                                echo "<script>alert('Data has been deactivated...');</script>";
                                            echo "<meta http-equiv='refresh' content='0, url=datatableCitizen.php'>"; 
                                            }else{
                                                echo "Failed to delete..."; 
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


