<nav class="navbar navbar-expand-md bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand">
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
                    <a class="nav-link" href="../index.php">
                    <i class="fa fa-home" aria-hidden="true" style="font-size: 15px;"></i>
                    Home</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">
                    <i class="fa fa-envelope" aria-hidden="true" style="font-size: 15px;"></i> 
                    Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">
                    <i class="fa fa-users" aria-hidden="true" style="font-size: 15px;"></i> 
                    About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user" style="font-size: 15px;" aria-hidden="true"></i>
                        <strong>
                            <?php
                                echo $_SESSION['estabUsername'];
                            ?>
                        </strong>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="logout.php" onclick="return confirm('Are you sure want to logout?')">
                            Logout
                        </a> 
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>