<?php           
include('../classes/dbcon.class.php');
include('../classes/barangay.class.php');
$authenBrgy = New Brgy();
$authenBrgy->authBrgy(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay</title>
    <?php include('../includes/layout/admin/adminsrclink.inc.php'); ?>
    <link href="../assets/css/sweetalert.css" rel="stylesheet">
</head>
<body>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i></a>
                <div class="">
                    <a class="brand" href="#">Barangay </a>
                </div>
            <div class="nav-collapse collapse navbar-inverse-collapse">
                <ul class="nav pull-right">
                    <li><a href="#">Contact</a></li>
                    <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- username-->
                        <strong>
                            <?php echo $_SESSION['brgyUsername']; ?>
                        </strong>
                        <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.nav-collapse -->
        </div>
    </div>
    <!-- /navbar-inner -->
</div>
<!-- /navbar -->
    <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div style="width:800px; margin : 0px auto;">
                        <div class="content">
                            <div class="module">
                                <div class="module-head">
                                    <h3>Registration for Citizen</h3>
                                </div>
                                <div class="module-body">
                                    <?php
                                        if (isset($_POST['submit'])) {
                                            $suffix = $_POST['suffix'];
                                            $fname = $_POST['fname'];
                                            $mname = $_POST['mname'];
                                            $lname = $_POST['lname'];
                                            $bdate = $_POST['bdate'];
                                            $address = $_POST['address'];
                                            $gender = $_POST['gender'];
                                            $cpnumber = $_POST['cpnumber'];
                                            $username = $_POST['username'];
                                            $password = $_POST['password'];
                                            $role = "Person";                                  
                                            $insertCitizen = New Brgy();
                                            $insertCitizen -> insertCitizen($fname, $mname, $lname, $suffix, $bdate, $address, $gender, $cpnumber,$username, $password, $role);
                                        }
                                    ?>
                                    <form class="form-horizontal row-fluid" method="POST" action="">
                                        <div class="control-group">
                                            <label class="control-label" for="Suffix">Suffix</label>
                                            <div class="controls">
                                                <input type="text" id="Suffix" name="suffix" placeholder="Suffix(e.g. Sr., Jr., II)" class="span8">
                                            </div>
                                        </div>
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
                                            <label class="control-label" for="Birth">Birth Date</label>
                                            <div class="controls">
                                                <input type="date" id="Birth" name="bdate" placeholder="Enter First Name" class="span8" required="">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="brgy">Brangay/Town/City</label>
                                            <div class="controls">
                                                <input id="brgy" type="text" name="address" placeholder="Enter Barangay" class="span8" required="">
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
                                                            <option>Osmeña (Lipata Saday) Bulan Sorsogon</option>
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
                                            <label class="control-label" for="gender">Gender</label>
                                            <div class="controls">
                                                <input id="gender" type="radio" name="gender" value="Male" required=""> Male
                                            </div>
                                            <div class="controls">
                                               <input id="gender" type="radio" name="gender" value="Female" required=""> Female 
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