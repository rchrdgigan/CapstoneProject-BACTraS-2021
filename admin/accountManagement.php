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
        <title>Account Management</title>
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
                                    <h3>Account Management</h3>
                                </div>
                                <div class="module-body">
                                    <ul>
                                        <a hidden>Bug</a><br>
                                        <a href="addUserAdmin.php">Add Admin Account</a><br>
                                        <a href="#" data-toggle="modal" data-target="#exampleModal">Change Password</a></li><br>
                                        <a href="datatableAdmin.php">Show Admin Account</a><br>
                                    </ul>
                                </div>
                            </div>
                            <!--/.module-->

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                </div>
                                <div class="modal-body">
                                    <label class="control-label" for="pass">Old Password</label>
                                    <div class="controls">
                                        <input id="pass" type="password" name="password" placeholder="Enter Password" required="">
                                    </div>
                                    <label class="control-label" for="pass">New Password</label>
                                    <div class="controls">
                                        <input id="pass" type="password" name="password" placeholder="Enter Password" required="">
                                    </div>
                                    <label class="control-label" for="pass">Confirm Password</label>
                                    <div class="controls">
                                        <input id="pass" type="password" name="password" placeholder="Enter Password" required="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                                </div>
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
    </body>


