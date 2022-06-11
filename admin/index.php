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
        <title>Admin Dashboard</title>
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
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="datatableCitizen.php" class="btn-box big span4">
                                    <!-- echo $countperson; -->
                                    <i class="icon-group"></i><b>
                                        <?php 
                                            $countCitizen = New Admin();
                                            $countCitizen->countCitizen();  
                                        ?>
                                    </b>
                                        <p class="text-muted">Registered User</p>
                                    </a>
                                    <a href="datatableEstablishment.php" class="btn-box big span4">
                                    <!-- echo $count; -->
                                    <i class="icon-user"></i>
                                        <b>
                                            <?php 
                                                $countEstablishment = New Admin();
                                                $countEstablishment->countEstablishment();  
                                            ?>
                                        </b>
                                        <p class="text-muted">
                                            Register Establishments
                                        </p>
                                    </a><a href="datatableHightemp.php" class="btn-box big span4">
                                    <i class="icon-user" style="color: red;"></i>
                                    <b>
                                        <?php 
                                            $countHightemp = New Admin();
                                            $countHightemp->countHightemp();  
                                        ?>
                                    </b>
                                        <p class="text-muted">
                                            High Temperature</p>
                                    </a>
                                </div>
                            </div>
                            <!--/#btn-controls-->
                            <!--/.module-->
                            <div class="module">
                                <div class="module-head">
                                    <h3>
                                        Data Tables</h3>
                                </div>
                                <div class="module-body table">
                                <?php  
                                    $tracingLog = new Admin();
                                    $tracingLog->getTracingLog();
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
    <!-- <script>
         $('#myTable').DataTable({
                ordered: [[3, 'desc']],
                pagingType: 'full_numbers'
        });
    </script> -->
        
</html>