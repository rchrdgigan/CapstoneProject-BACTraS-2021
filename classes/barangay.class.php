<?php

class Brgy extends Dbcon {
    //LOGIN ADMIN
    public function loginBarangay($username, $password){ 
        $sql = "SELECT * FROM tb_brgy WHERE brgyUsername = ? AND brgyPass = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username , $password]);
        $userCount = $stmt->rowCount();
        $brgys = $stmt->fetchAll();
        if($userCount > 0){
            foreach ($brgys as $brgy) {
                session_start();
                $_SESSION['brgyUsername'] = $brgy['brgyUsername'];
                $_SESSION['role'] = $brgy['role'];
                header("Location:barangay/index.php");
            }
        }else {
            echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'."Invalid Account! Please try again..".'</div></center>';
        }
    }
    //AUTHENTICATION
    public function authBrgy(){
        session_start();
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] != 'Brgy') {
                if ($_SESSION['role'] != 'Merchant') {
                    header("Location:user.php");
                    exit();
                }
                if ($_SESSION['role'] != 'User') {
                    header("Location:merchant.php");
                    exit();
                } 
            }
        } else {
            header("Location:../brgy.php");
        }
    }
    //INSERT CITIZEN
    public function insertCitizen($fname, $mname, $lname, $suffix, $bdate, $address, $gender, $cpnumber,$username, $password, $role){
        try {
            //code...
            date_default_timezone_set("Asia/Manila");
            $createAt = Date('Y-m-d H:i:sa');
            $sql = "INSERT INTO tb_citizen (id, firstName, middleName, lastName, suffix, birthDate, homeAddress, gender, contactNumber, citizenUsername, citizenPass, role, createAt) VALUES (NULL , ? , ? , ? , ? , ?, ? , ? , ? , ? , ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$fname, $mname, $lname, $suffix, $bdate, $address, $gender, $cpnumber,$username, $password, $role, $createAt]);
            echo '<script>
                    setTimeout(function () {
                        swal({
                            title: "Successfully!",
                            text: "Successfully registered new data...",
                            type: "success",
                        },function(isConfirm) {	
                            if(isConfirm){						
                            window.location.href = "../barangay/index.php?Status=Successfully";
                            }
                        });
                    },);
                </script>';
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }

}