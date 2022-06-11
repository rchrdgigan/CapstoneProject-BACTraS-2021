<?php 
    include('../classes/dbcon.class.php');
    include('../classes/establishment.class.php');
    $authenEstablis=new Establishment();
    $authenEstablis->authEstablishment();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="">
    <title>Tracing Log</title>
    <?php include('../includes/layout/merchant/merchsrclink.inc.php'); ?>
</head>
<body>
<!-- includes refraction -->
<?php include('../includes/layout/merchant/merchnav.inc.php'); ?>
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header"><a name="businessName"><?php echo $_SESSION['businessName']; ?></a></div>
                    <div class="card-body">
                        
                        <form method="POST" action="">
                            <?php
                                if(isset($_GET["qrid"])){
                                    $search = $_GET['qrid'];
                                    if($search === ""){
                                        header("Location:index.php");
                                    }else {
                                        $str = explode("A",$search);
                                        $p_id = $str[0];
                                        $createAt = $str[1];
                                        $searchCitizen=New Establishment();
                                        $searchCitizen->searchCitizen($p_id, $createAt);
                                    }   
                                } 
                                if(isset($_POST['submit'])){
                                    $tempera= $_POST['temperature'];
                                    $citizen_id= $_SESSION['citizen_id'];
                                    $estab_id= $_SESSION['estab_id'];
                                    $insertlogCitizen = New Establishment();
                                    $insertlogCitizen->insertlogCitizen($citizen_id, $estab_id, $tempera);
                                }  
                            ?>
                            <!-- time -->
                           
                            <input name="businessName" value="<?php echo $_SESSION['businessName']; ?>" hidden> 
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name : </label>
                                <div class="col-md-6">
                                    <input name="fullname" class="form-control" readonly value="<?php echo $_SESSION['fullname']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Address : </label>
                                <div class="col-md-6">
                                    <input name="address" class="form-control" readonly value="<?php echo $_SESSION['address']; ?>">           
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right">Contact Number : </label>
                                <div class="col-md-6">
                                    <input name="cpnumber" class="form-control" readonly value="<?php echo $_SESSION['contactNo']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="temperature" class="col-md-4 col-form-label text-md-right">Temperature : </label>
                                <div class="col-md-6">
                                    <input id="temperature" type="text" class="form-control" name="temperature" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" name="submit" class="btn btn-success">
                                        Submit
                                    </button>
                                    <a href= "index.php"  class="btn btn-danger">
                                        Cancel
                                    </a>
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
</html>