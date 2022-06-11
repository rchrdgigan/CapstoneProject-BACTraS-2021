<?php 
    include('classes/dbcon.class.php');
    include('classes/citizen.class.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Citizen Login</title>
    <?php include('includes/layout/main/srclink.inc.php'); ?>
</head>
<body>
    <?php include('includes/layout/main/nav.inc.php'); ?>
<main>
<div class="container" id="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5 mb-5">
            <div class="card">
                <div class="card-header">Citizen Login</div>
                <div class="card-body">
                    <?php
                        if (isset($_GET['status'])){
                            $status=$_GET['status'];
                            if($status = 'deactivated'){
                             echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'. "This account is deactivated.." . '</div></center>';
                            }
                        }
                        if (isset($_POST['submit'])) {
                            $username = $_POST['username'];
                            $password = $_POST['password'];

                            if (strlen($password) < 6) {
                                echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'. "Password must contain at least 6 characters.." . '</div></center>';
                            } elseif (strlen($password) > 20) {
                                echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'. "Password must be less than 20 characters.." . '</div></center>';
                            }
                            else {
                                $citizen = New Citizen();
                                $citizen->loginCitizen($username,$password);
                            }
                        }
                    ?>
                    <form method="POST" action="">
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control" name="username" value="" autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                <a class="btn col-md-6" href="#">
                                <input type="checkbox" id="remember">
                                <label for="remember" class="text-sm font-semibold text-gray-500">Remember me</label>
                                </a>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" name="submit" class="btn btn-primary col-md-4 mb-1">
                                    Login
                                </button>
                                <a href="index.php" class="btn btn-danger col-md-4 mb-1">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
    <?php include('includes/layout/main/footer.inc.php'); ?>
</body>
</html>