<?php 
    include('../classes/dbcon.class.php');
    include('../classes/establishment.class.php');
    $authenEstablis = New Establishment();
    $authenEstablis->authEstablishment(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home BACTraS</title>
    <?php include('../includes/layout/merchant/merchsrclink.inc.php'); ?>
</head>
<body>
    <!-- includes refraction -->
    <?php include('../includes/layout/merchant/merchnav.inc.php'); ?>
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <!-- This is scanner -->
                <div class="card mb-3">
                    <div class="card-header">Scan QR Code Here!</div>
                        <div class="card-body">
                            <video id="preview" class="col-sm-12 col-md-12 col-lg-12 col-xl-12"></video>
                            <?php 
                                if(isset($_GET["status"])){
                                    $search = $_GET['status'];
                                    if($search == "Deativated"){
                                        $_GET['status']="";
                                        echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'. "This account is deactivated.." . '</div></center>';
                                    }elseif($search == "Invalid") {
                                        $_GET['status']="";
                                        echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'. "QR Code ID is Invalid.." . '</div></center>';
                                    }elseif($search == "Success") {
                                        $_GET['status']="";
                                        echo '<center><div class="alert alert-success" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'. "Successfully submitted.." . '</div></center>';
                                    }
                                }
                            ?>
                        </div>  
                        <form method="POST" action="">
                                <div class="form-group row">
                                    <div class="col-md-4" style="margin: 0px auto;">
                                        <input hidden type="text" value="" readonly="" name="qrid" id="qrstr" class="form-control" style="border-radius : 20px;">
                                    </div>
                                </div>
                            </form>
                     </div>
                </div> 
            </div>
        </div>
    </div> 
</main>
    <?php include('../includes/layout/main/footer.inc.php'); ?>  
</body>
    <script src="../assets/js/myscanner.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</html>