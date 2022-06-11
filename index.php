<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BACTraS Home</title>
    <?php include('includes/layout/main/srclink.inc.php'); ?>
</head>
<body>
    <?php include('includes/layout/main/nav.inc.php'); ?>
<main>
<!-- container-->
<div class="container" id="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5 mb-5">
            <div class="card">
                <div class="card-header">Welcome to BACTraS!</div>
                <div class="card-body">
                    <a href="citizen.php"><button class="pers"><i class="fa fa-user fa-2x" aria-hidden="true"></i>Citizen Login</button></a>
                    <a href="merchant.php"><button class="merch"><i class="fa fa-bank fa-2x" aria-hidden="true"></i>Establishment Login</button></a>
                    <a href="">Privacy Notice</a><br>
                    <a href="">Frequently Asked Questions(FAQs)</a>      
                </div>                 
            </div>
        </div>
    </div>
</div>
<!-- end container-->
</main>
    <?php include('includes/layout/main/footer.inc.php'); ?>
</body>
</html>