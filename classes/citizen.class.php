<?php

class Citizen extends Dbcon {
    //LOGIN CITIZEN
    public function loginCitizen($username,$password){
        $sql = "SELECT * From tb_citizen WHERE citizenUsername = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $userCount = $stmt->rowCount();
        $citizens = $stmt->fetchAll();
        if($userCount > 0){
            foreach ($citizens as $citizen) {
                $hashpassword = password_verify($password, $citizen['citizenPass']);
                if($hashpassword == 1){
                    session_start();
                    $_SESSION['citizenUsername'] = $citizen['citizenUsername'];
                    $_SESSION['role'] = $citizen['role'];
                    $_SESSION['status'] = $citizen['status'];
                    // echo "<script>window.location.href = 'citizen/index.php';</script>";
                    header("location:citizen/index.php");
                }else {
                    echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'."Invalid Password! Please try again..".'</div></center>';
                }
            }
        }else {
            echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'."Invalid Account! Please try again..".'</div></center>';
        } 
    }
    //AUTHENTICATION
    public function authCitizen(){
        session_start();
        if(isset($_SESSION['status'])) {
            if ($_SESSION['status'] != 'deactivated') {
            } else {
                header("Location:../citizen.php?status=deactivated");
            }
        }
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] != 'Person') {
                if ($_SESSION['role'] != 'Merchant') {
                    header("Location:admin.php");
                    exit();
                }
                if ($_SESSION['role'] != 'Admin') {
                    header("Location:merchant.php");
                    exit();
                } 
            }
        } else {
            header("Location:../citizen.php");
        }
    }
    //GET CITIZEN INFO
    public function getidCitizen($username, $role){ 
        $sql = "SELECT * FROM tb_citizen WHERE citizenUsername = ? AND role = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username, $role]);
        $rowCount = $stmt->rowCount();
        $citizens = $stmt->fetchAll();
        if($rowCount > 0){
            foreach($citizens as $citizen){
            echo "<label id='id' hidden>".$citizen['id']."A".$citizen['createAt']."</label>
            Your Name:<label>".$citizen['suffix'].' '.$citizen['firstName'].' '.$citizen['middleName'].' '.$citizen['lastName']."</label><br>
            Your Address:<label>".$citizen['homeAddress']."</label><br> 
            Your Phone Number:<label>".$citizen['contactNumber']."</label><br>";
            }
        }
        
    }
}