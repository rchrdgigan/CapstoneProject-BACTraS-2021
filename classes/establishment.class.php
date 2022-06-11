<?php

class Establishment extends Dbcon {
    //LOGIN CITIZEN
    public function loginEstablishment($username,$password){
        $sql = "SELECT * From tb_establishment WHERE estabUsername = ? AND estabPass = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username , $password]);
        $userCount = $stmt->rowCount();
        $establishment = $stmt->fetchAll();
        if($userCount > 0){
            foreach ($establishment as $establishment) {
                session_start();
                $_SESSION['estab_id'] = $establishment['id'];
                $_SESSION['estabUsername'] = $establishment['estabUsername'];
                $_SESSION['role'] = $establishment['role'];
                $_SESSION['businessName'] = $establishment['businessName']; 
                $_SESSION['status'] = $establishment['status'];
                //echo "<script>window.location.href = 'merchant/index.php';</script>";
                header("location:merchant/index.php");
            }
        }else {
            echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'."Invalid Account! Please try again..".'</div></center>';
        } 
    }
    //AUTHENTICATION
    public function authEstablishment(){
        session_start();
        if(isset($_SESSION['status'])) {
            if ($_SESSION['status'] != 'deactivated') {
            }else {
                header("Location:../merchant.php?status=deactivated");
            }   
        }
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] != 'Merchant') {
                if ($_SESSION['role'] != 'Admin') {
                    header("Location:user.php");
                    exit();
                }
                if ($_SESSION['role'] != 'User') {
                    header("Location:admin.php");
                    exit();
                }
            }
        } else {
            header("Location:../merchant.php");
        }
    }
    //SEARCH QRID
    public function searchCitizen($p_id, $createAt) { 
        $sql = "SELECT * FROM tb_citizen WHERE id = ? AND createAt = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$p_id, $createAt]);
        $citizens = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();
        if($rowCount > 0){
            foreach($citizens as $citizen){
                $_SESSION['citizen_id']=$citizen['id'];
                $_SESSION['fullname']=$citizen['suffix']." ".$citizen['firstName']." ".$citizen['middleName']." ".$citizen['lastName'];
                $_SESSION['address']=$citizen['homeAddress'];
                $_SESSION['contactNo']=$citizen['contactNumber'];
                $_SESSION['citizen']=$citizen['status'];
                $status = $_SESSION['citizen'];
                if($status == 'deactivated'){
                    header("Location:index.php?status=Deactivated");
                //echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'. "This account is deactivated.." . '</div></center>';
                }elseif($status == 'active') {
                    header("location:tracinglog.php");
                }
            }
        }else {
            header("Location:index.php?status=Invalid");
        }
    }
    //INSERT CITIZEN
    public function insertlogCitizen($citizen_id, $estab_id, $tempera){
        try {
            //code...
            date_default_timezone_set("Asia/Manila");
            $tracingDateTime = Date('Y-m-d H:i:sa');
            $sql = "INSERT INTO tb_tracinglog (tracing_id, citizen_id, estaB_id, tracingDateTime, temperature) VALUES (Null, ? , ? , ? , ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$citizen_id, $estab_id, $tracingDateTime, $tempera]);
            
            header("location:index.php?status=Success");
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
        
    }

}