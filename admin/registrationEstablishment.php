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
        <title>Establisment Registration</title>
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
                                <h3>Registration for Establisment</h3>
                            </div>
                            <div class="module-body">
                                <?php
                                    if (isset($_POST['submit'])) {
                                        $bname = $_POST['bname'];
                                        $baddress = $_POST['baddress'];
                                        $cperson = $_POST['cperson'];
                                        $emailadd = $_POST['emailadd'];
                                        $cpnumber = $_POST['cpnumber'];
                                        $username = $_POST['username'];
                                        $password = $_POST['password'];
                                        $role = "Merchant";
                                        $insertEstablishment = new Admin();
                                        $insertEstablishment->insertEstablishment($bname, $baddress, $cperson, $emailadd, $cpnumber,$username,$password,$role);
                                    }
                                ?>
                                    <form class="form-horizontal row-fluid" method="POST" action="registrationEstablishment.php">
                                        <div class="control-group">
                                            <label class="control-label" for="bname">Business Name</label>
                                            <div class="controls">
                                                <input type="text" name="bname" id="bname" placeholder="Enter Business Name" class="span8" required="">
                                                <!-- <span class="help-inline"></span> -->
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="brgy">Brangay/Town/City</label>
                                            <div class="controls">
                                                <input id="brgy" type="text" name="baddress" placeholder="Enter Barangay" class="span8" required="">
                                               <!--  <span class="help-inline">Minimum 5 Characters</span> -->
                                            </div>
                                            <div class="controls" style="margin-top: 5px;">
                                                <select id="selectbrgy" onchange="d1select();">
                                                        <option hidden="">--select option--</option>
                                                        <option>A. Bonifacio (Tinurilan) Bulan Sorsogon</option>
                                                        <option>Abad Santos (Kambal) Bulan Sorsogon</option>
                                                        <option>Aguinaldo (Lipata Dako) Bulan Sorsogon</option>
                                                         <option>Antipolo Bulan Sorsogon</option>
                                                         <option>Aquino (Imelda) Bulan Sorsogon</option>
                                                         <option>Bical Bulan Sorsogon</option>
                                                         <option>Beguin Bulan Sorsogon</option>
                                                         <option>Bonga Bulan Sorsogon</option>
                                                         <option>Butag Bulan Sorsogon</option>
                                                         <option>Cadandanan Bulan Sorsogon</option>
                                                         <option>Calomagon Bulan Sorsogon</option>
                                                         <option>Calpi Bulan Sorsogon</option>
                                                         <option>Cocok-Cabitan Bulan Sorsogon</option>
                                                         <option>Daganas Bulan Sorsogon</option>
                                                         <option>Danao Bulan Sorsogon</option>
                                                         <option>Dolos Bulan Sorsogon</option>
                                                         <option>E. Quirino (Pinangomhan) Bulan Sorsogon</option>
                                                         <option>Fabrica Bulan Sorsogon</option>
                                                         <option>G. Del Pilar (Tanga) Bulan Sorsogon</option>
                                                         <option>Gate Bulan Sorsogon</option>
                                                         <option>Inararan Bulan Sorsogon</option>
                                                         <option>J. Gerona (Biton) Bulan Sorsogon</option>
                                                         <option>J.P. Laurel (Pon-od) Bulan Sorsogon</option>
                                                         <option>Jamorawon</option>
                                                         <option>Libertad (Calle Putol) Bulan Sorsogon</option>
                                                         <option>Lajong Bulan Sorsogon</option>
                                                         <option>Magsaysay (Bongog) Bulan Sorsogon</option>
                                                         <option>Managa-naga Bulan Sorsogon</option>
                                                         <option>Marinab Bulan Sorsogon</option>
                                                         <option>Nasuje Bulan Sorsogon</option>
                                                         <option>Montecalvario Bulan Sorsogon</option>
                                                         <option>N. Roque (Calayugan) Bulan Sorsogon</option>
                                                         <option>Namo Bulan Sorsogon</option>
                                                         <option>Obrero Bulan Sorsogon</option>
                                                         <option>Osme??a (Lipata Saday) Bulan Sorsogon</option>
                                                         <option>Otavi Bulan Sorsogon</option>
                                                         <option>Padre Diaz Bulan Sorsogon</option>
                                                         <option>Palale Bulan Sorsogon</option>
                                                         <option>Quezon (Cabarawan) Bulan Sorsogon</option>
                                                         <option>R. Gerona (Butag) Bulan Sorsogon</option>
                                                         <option>Recto Bulan Sorsogon</option>
                                                         <option>Roxas (Busay) Bulan Sorsogon</option>
                                                         <option>Sagrada Bulan Sorsogon</option>
                                                         <option>San Francisco (Polot) Bulan Sorsogon</option>
                                                         <option>San Isidro (Cabugaan) Bulan Sorsogon</option>
                                                         <option>San Juan Bag-o Bulan Sorsogon</option>
                                                         <option>San Juan Daan Bulan Sorsogon</option>
                                                         <option>San Rafael (Togbongon) Bulan Sorsogon</option>
                                                         <option>San Ramon Bulan Sorsogon</option>
                                                         <option>San Vicente Bulan Sorsogon</option>
                                                         <option>Santa Remedios Bulan Sorsogon</option>
                                                         <option>Santa Teresita (Trece) Bulan Sorsogon</option>
                                                         <option>Sigad Bulan Sorsogon</option>
                                                         <option>Somagongsong Bulan Sorsogon</option>
                                                         <option>Tarhan Bulan Sorsogon</option>
                                                         <option>Taromata Bulan Sorsogon</option>
                                                         <option>Zone 1 (Ilawod) Bulan Sorsogon</option>
                                                         <option>Zone 2 (Sabang) Bulan Sorsogon</option>
                                                         <option>Zone 3 (Central) Bulan Sorsogon</option>
                                                         <option>Zone 4 (Central Business District) Bulan Sorsogon</option>
                                                         <option>Zone 5 (Canipaan) Bulan Sorsogon</option>
                                                         <option>Zone 6 (Baybay) Bulan Sorsogon</option>
                                                         <option>Zone 7 (Iraya) Bulan Sorsogon</option>
                                                         <option>Zone 8 (Loyo) Bulan Sorsogon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="cperson">Contact Person</label>
                                            <div class="controls">
                                                <input type="text" name="cperson" id="cperson" placeholder="Manager/Representative" class="span8" required="">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="emailadd">Email Address</label>
                                            <div class="controls">
                                                <input type="text" name="emailadd" id="emailadd" placeholder="Enter Email (e.g, username@email.com)" class="span8" required="">
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
                                                <button name="submit" type="Submit" class="btn">Submit Form</button>
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