<?php           
    include('../classes/dbcon.class.php');
    include('../classes/admin.class.php');
    $authenAdmin = New Admin();
    $authenAdmin->authAdmin(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Code ID</title>
    <?php include('../includes/layout/person/persrclink.ink.php'); ?>
</head>
<body>
<nav class="navbar navbar-expand-md bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <div class="bactras-img">
                <img src="../assets/img/BACTRAS_LOGO.png">   
            </div>           
        </a>
        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="#">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                    <i class="fa fa-home" aria-hidden="true" style="font-size: 15px;">
                    </i>Home</a>
                </li> 
                
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user" style="font-size: 15px;" aria-hidden="true"></i>
                        <strong>
                            Admin
                        </strong>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="logout.php">
                            Logout
                        </a> 
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main class="py-4">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3 qrcode-card">
                <div class="card-header no-print">Your QR Code Identity is Here!</div>
                <div class="card-body">
                    <div class="page print mb-4" id="downloadqr">
                        <div class="d-flex align-items-center"> 
                            <div class="col-md-4 p-2">                      
                                <div class="bulan-logo">
                                    <img src="../assets/img/bulan.png"> 
                                </div>
                            </div>
                            <div class="col-md-4 p-2"> 
                                <div class="text-center">
                                    Republic of the Philippines<br>
                                    Bulan, Sorsogon<br>
                                    <label style="font-weight: bold;">QR CODE IDENTITY</label><br>
                                </div>
                            </div>
                            <div class="col-md-4 p-2">
                                <div class="logo-namo">
                                    <img src="../assets/img/BACTRAS_LOGO.png">
                                </div>  
                            </div> 
                        </div>
                        <div class="row d-flex align-items-center">
                            <div class="imgprof col-md-2 mb-2">
                                <div class="img-prof"></div>
                            </div>
                            <div class="col-md-4 text-center">
                                <?php
                                    if(isset($_GET['citizen_id'])){
                                        $citizen_id = $_GET['citizen_id'];
                                        $displayCitizeninfo = New Admin();
                                        $displayCitizeninfo->displayCitizeninfo($citizen_id);
                                    }
                                ?>
                            </div>
                            <div class="col-md-4">
                                <div id="qrcode" class="qrcode-design"></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <button id="downloadbtn" class="no-print btn btn-primary">Download</button>
                    <button id="btnprnt" type="submit" class="no-print btn btn-warning">Print</button>
                    <a href="datatableCitizen.php"><button type="submit" class="no-print btn btn-danger">Back</button></a>
                </div>       
            </div>
        </div>
    </div>
</div>
</main>
    <?php include('../includes/layout/main/footer.inc.php'); ?>  
</body>
</html>