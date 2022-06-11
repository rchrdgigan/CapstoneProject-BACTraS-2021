<?php 

class Admin extends Dbcon {
    //LOGIN ADMIN
    public function loginAdmin($username, $password){ 
        $sql = "SELECT * From tb_admin WHERE adminUsername = ? AND adminPass = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username , $password]);
        $userCount = $stmt->rowCount();
        $admins = $stmt->fetchAll();
        if($userCount > 0){
            foreach ($admins as $admin) {
                session_start();
                $_SESSION['Admin'] = $admin['adminUsername'];
                $_SESSION['role'] = $admin['role'];
                header("Location:admin/index.php");
            }
        }else {
            echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'."Invalid Account! Please try again..".'</div></center>';
        }
    }
    //AUTHENTICATION
    public function authAdmin(){
        session_start();
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] != 'Admin') {
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
            header("Location:../admin.php");
        }
    }
    //DISPLAY TRACING LOG
    public function getTracingLog(){ 
        $sql = "SELECT tb_citizen.firstName, tb_citizen.middleName, tb_citizen.lastName, tb_citizen.suffix, tb_citizen.homeAddress, tb_citizen.contactNumber, tb_establishment.businessName, tb_tracinglog.temperature, tb_tracinglog.tracingDateTime 
        FROM tb_tracinglog INNER JOIN tb_citizen ON tb_tracinglog.citizen_id = tb_citizen.id 
        INNER JOIN tb_establishment ON tb_tracinglog.estab_id = tb_establishment.id 
        ORDER BY tb_tracinglog.tracing_id DESC";
        $stmt = $this->connect()->query($sql);
        $rowCount = $stmt->rowCount();
        if($rowCount > 0){
            echo '<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped"
            width="100%">
            <thead>
                <tr>
                    <th>Time and Date</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th>Establishment</th>
                    <th>Temperature</th>
                </tr>
            </thead><tbody>';
            while($row = $stmt->fetch()){
                echo "
                <td>".$row['tracingDateTime']."</td>
                <td>".$row['firstName']." ".$row['middleName']." ".$row['lastName']." ".$row['suffix']."</td>
                <td>".$row['homeAddress']."</td>
                <td>".$row['contactNumber']."</td>
                <td>".$row['businessName']."</td>
                <td>".$row['temperature']."</td></tr>
                ";
            }
            echo "</tbody></table>";
        }else {
            echo "No Data Found";
        }
    }
    //DISPLAY TRACING TABLE DESC
    public function getTracingTables(){ 
        $sql = "SELECT tb_citizen.firstName, tb_citizen.middleName, tb_citizen.lastName, tb_citizen.suffix, tb_citizen.homeAddress, tb_citizen.contactNumber, tb_establishment.businessName, tb_tracinglog.temperature, tb_tracinglog.tracingDateTime 
        FROM tb_tracinglog INNER JOIN tb_citizen ON tb_tracinglog.citizen_id = tb_citizen.id 
        INNER JOIN tb_establishment ON tb_tracinglog.estab_id = tb_establishment.id 
        ORDER BY tb_tracinglog.tracing_id DESC";
        $stmt = $this->connect()->query($sql);
        $rowCount = $stmt->rowCount();
        if($rowCount > 0){
            while($row = $stmt->fetch()){
                echo "<tr>
                <td>".$row['tracingDateTime']."</td>
                <td>".$row['firstName']." ".$row['middleName']." ".$row['lastName']." ".$row['suffix']."</td>
                <td>".$row['homeAddress']."</td>
                <td>".$row['contactNumber']."</td>
                <td>".$row['businessName']."</td>
                <td>".$row['temperature']."</td></tr>
                ";
            }
        }else {
            echo "No Data Found";
        }
    }
    //INSERT CITIZEN
    public function insertCitizen($fname, $mname, $lname, $suffix, $bdate, $address, $gender, $cpnumber,$username, $password, $role){
        try {
            $sql = "SELECT * From tb_citizen WHERE citizenUsername = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username]);
            $userCount = $stmt->rowCount();
            $admins = $stmt->fetchAll();
            if($userCount > 0){
                echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'."Account already exist! Please try again another account..".'</div></center>';
            }else {
                //code...
                date_default_timezone_set("Asia/Manila");
                $createAt = Date('Y-m-d H:i:sa');
                $status = 'active';
                $sql = "INSERT INTO tb_citizen (id, firstName, middleName, lastName, suffix, birthDate, homeAddress, gender, contactNumber, citizenUsername, citizenPass, role, createAt, status) VALUES (NULL , ? , ? , ? , ? , ?, ? , ? , ? , ? , ?, ?, ?, ?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$fname, $mname, $lname, $suffix, $bdate, $address, $gender, $cpnumber,$username, $password, $role, $createAt, $status]);
                echo '<script>
                        setTimeout(function () {
                            swal({
                                title: "Successfully!",
                                text: "Successfully registered new data...",
                                type: "success",
                            },function(isConfirm) { 
                                if(isConfirm){                      
                                window.location.href = "../admin/registrationCitizen.php?Status=Successfully";
                                }
                            });
                        },);
                    </script>';
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }
    //INSERT ESTABLISHMENT
    public function insertEstablishment($bname, $baddress, $cperson, $emailadd, $cpnumber,$username,$password,$role){
        try {
             $sql = "SELECT * From tb_establishment WHERE estabUsername = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username]);
            $userCount = $stmt->rowCount();
            $admins = $stmt->fetchAll();
            if($userCount > 0){
                echo '<center><div class="alert alert-danger" role="alert" ><button type="button" class="close" data-dismiss="alert">×</button>'."Account already exist! Please try again another account..".'</div></center>';
            }else {
            //code...
                date_default_timezone_set("Asia/Manila");
                $createAt = Date('Y-m-d H:i:sa');
                $status = 'active';
                $sql = "INSERT INTO tb_establishment (id, businessName, businessAddress, contactPerson, emailAddress, contactNumber, estabUsername, estabPass, role, createAt, status) VALUES (NULL , ? , ? , ? , ? , ?, ? , ? , ?, ?, ?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$bname, $baddress, $cperson, $emailadd, $cpnumber,$username,$password,$role, $createAt, $status]);
                echo '<script>
                        setTimeout(function () {
                            swal({
                                title: "Successfully!",
                                text: "Successfully registered new data...",
                                type: "success",
                            },function(isConfirm) {	
                                if(isConfirm){						
                                window.location.href = "../admin/registrationEstablishment.php?Status=Successfully";
                                }
                            });
                        },);
                    </script>';
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }
    //COUNT CITIZEN
    public function countCitizen(){
        $sql = "SELECT * FROM tb_citizen";
        $stmt = $this->connect()->query($sql);
        $countCitizen=$stmt->rowCount();
        echo $countCitizen; 
    }
    //COUNT ESTABLISHMENTS
    public function countEstablishment(){
        $sql = "SELECT * FROM tb_establishment";
        $stmt = $this->connect()->query($sql);
        $countEstablishment=$stmt->rowCount();
        echo $countEstablishment; 
    }
    //COUNT HIGHTEMP CITIZEN
    public function countHightemp(){
        $sql = "SELECT tb_tracinglog.tracing_id, tb_citizen.firstName, tb_citizen.middleName, tb_citizen.lastName, tb_citizen.suffix, tb_citizen.homeAddress, tb_citizen.contactNumber, tb_establishment.businessName, tb_tracinglog.temperature, tb_tracinglog.tracingDateTime 
        FROM tb_tracinglog INNER JOIN tb_citizen ON tb_tracinglog.citizen_id = tb_citizen.id 
        INNER JOIN tb_establishment ON tb_tracinglog.estab_id = tb_establishment.id
        WHERE tb_tracinglog.temperature > 39";
        $stmt = $this->connect()->query($sql);
        $countHightemp=$stmt->rowCount();
        echo $countHightemp; 
    }
    //DISPALY ESTABLISHMENTS
    public function getEstablishment(){ 
        $sql = "SELECT id, businessName, businessAddress, contactPerson, emailAddress, contactNumber, createAt FROM tb_establishment WHERE status='active' ORDER BY tb_establishment.id DESC";
        $stmt = $this->connect()->query($sql);
        $rowCount = $stmt->rowCount();
        if($rowCount > 0){
            echo '<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display"
            width="100%">
            <thead>
                <tr>
                    <th>Time and Date</th>
                    <th>Business Name</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th>Cellphone Number</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead><tbody>';
            while($row = $stmt->fetch()){
                echo "<tr>
                <td>".$row['createAt']."</td>
                <td>".$row['businessName']." ".$row['businessAddress']."</td>
                <td>".$row['contactPerson']."</td>
                <td>".$row['emailAddress']."</td>
                <td>".$row['contactNumber']."</td>
                <td><a class='btn btn-danger' href='?deativate_estab=".$row['id']."'>Archive</a></td>
                <td><a type='button' class='btn btn-primary' href='editEstablishment.php?edit_estab=".$row['id']."'>Edit</a></td>
                </tr>";
            }
            echo "</tbody></table>";
        }else {
            echo "No Data Found";
        }
    }
     //RETRIVE ESTABLISHMENTS
    public function getdeactivateEstablishment(){ 
        $sql = "SELECT id, businessName, businessAddress, contactPerson, emailAddress, contactNumber, createAt FROM tb_establishment WHERE status='deactivated' ORDER BY tb_establishment.id DESC";
        $stmt = $this->connect()->query($sql);
        $rowCount = $stmt->rowCount();
        if($rowCount > 0){
            echo '<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display"
            width="100%">
            <thead>
                <tr>
                    <th>Time and Date</th>
                    <th>Business Name</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th>Cellphone Number</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead><tbody>';
            while($row = $stmt->fetch()){
                echo "<tr>
                <td>".$row['createAt']."</td>
                <td>".$row['businessName']." ".$row['businessAddress']."</td>
                <td>".$row['contactPerson']."</td>
                <td>".$row['emailAddress']."</td>
                <td>".$row['contactNumber']."</td>
                <td><a class='btn btn-success' href='?active_estab=".$row['id']."'>Retrive</a></td>
                </tr>";
            }
            echo "</tbody></table>";
        }else {
            echo "No Data Found";
        }
    }
    //DEACTIVED ESTABLISH
    public function deativateEstablish($id){ 
        $sql = "SELECT * FROM tb_establishment WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $rowCount = $stmt->rowCount();
        $estabs = $stmt->fetchAll();
        if($rowCount > 0){
            foreach($estabs as $estab){
                $_SESSION['status']=$estab['status'];
            }
        }
        if ($_SESSION['status'] = 'active') {
            $status = 'deactivated';
            $sql = "UPDATE tb_establishment SET status= ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$status, $id]);
        }
            
    }
    //ACTIVATE ESTABLISH
    public function activeEstablish($id){ 
        $sql = "SELECT * FROM tb_establishment WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $rowCount = $stmt->rowCount();
        $estabs = $stmt->fetchAll();
        if($rowCount > 0){
            foreach($estabs as $estab){
                $_SESSION['status']=$estab['status'];
            }
        }
        if ($_SESSION['status'] = 'deactivated') {
            $status = 'active';
            $sql = "UPDATE tb_establishment SET status= ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$status, $id]);
        }
            
    }
    //EDIT ESTABLISHMENT
    public function showEstablishmenttext($id){
        $sql = "SELECT * FROM tb_establishment WHERE id= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $estabs = $stmt->fetchAll();
        foreach ($estabs as $estab) {
            echo'
            <form class="form-horizontal row-fluid" method="POST" action="">
                <div class="control-group">
                    <label class="control-label" for="bname">Business Name</label>
                    <div class="controls">
                        <input type="text" name="bname" value="'.$estab['businessName'].'" id="bname" placeholder="Enter Business Name" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="brgy">Brangay/Town/City</label>
                    <div class="controls">
                        <input id="brgy" type="text" name="baddress" value="'.$estab['businessAddress'].'" placeholder="Enter Barangay" class="span8" required="">
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
                    <label class="control-label" for="cperson">Contact Person</label>
                    <div class="controls">
                        <input type="text" name="cperson" value="'.$estab['contactPerson'].'" id="cperson" placeholder="Manager/Representative" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="emailadd">Email Address</label>
                    <div class="controls">
                        <input type="text" name="emailadd" value="'.$estab['emailAddress'].'" id="emailadd" placeholder="Enter Email (e.g, username@email.com)" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="contact1">Cellphone</label>
                    <div class="controls">
                        <input id="contact1" name="cpnumber" value="'.$estab['contactNumber'].'" type="text" onchange="valnumblenght();" onkeypress="isInputNumber(event);" placeholder="09XXXXXXXXX" class="span8" required="">
                        <span class="help-inline"><label id="lbltxt" class="text-danger"></label></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="username">Username</label>
                    <div class="controls">
                        <input id="username" type="text" name="username" value="'.$estab['estabUsername'].'" placeholder="Enter Username" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="pass">Password</label>
                    <div class="controls">
                        <input id="pass" type="password" name="password" value="'.$estab['estabPass'].'" placeholder="Enter Password" class="span8"  required="">
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
                        <button name="submit" type="submit" class="btn btn-success">Update Form</button>
                    </div>
                </div>
            </form>
            ';
        }
    }
    //UPDATE ESTABLISHMENT
    public function updateEstablishment($bname, $baddress, $cperson, $emailadd, $cpnumber,$username,$password,$role, $createAt, $estab_id){
        try{
           $sql = "UPDATE tb_establishment SET businessName=?, businessAddress=?, contactPerson=?, emailAddress=?, contactNumber=?, estabUsername=?, estabPass=?, role=?, createAt=? WHERE id = ?";
           $stmt = $this->connect()->prepare($sql);
           $stmt->execute([$bname, $baddress, $cperson, $emailadd, $cpnumber,$username,$password,$role, $createAt, $estab_id]);
           echo '<script>
                   setTimeout(function () {
                       swal({
                           title: "Successfully!",
                           text: "Successfully Updated...",
                           type: "success",
                       },function(isConfirm) {	
                           if(isConfirm){						
                           window.location.href = "../admin/datatableEstablishment.php?Status=Successfully";
                           }
                       });
                   },);
               </script>';
           } catch (\Throwable $th) {
               //throw $th;
               echo $th;
           }
       }
    //DISPALY CITIZEN
    public function getCitizen(){ 
        $sql = "SELECT id, firstName, middleName, lastName, suffix, birthDate, gender, contactNumber, homeAddress, createAt FROM tb_citizen WHERE status = 'active' ORDER BY tb_citizen.id DESC";
        $stmt = $this->connect()->query($sql);
        $rowCount = $stmt->rowCount();
        if($rowCount > 0){
            echo '<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
            width="100%">
            <thead>
                <tr>
                    <th>Date and Time</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Birth date</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th colspan="4">Action</th>
                </tr>
            </thead><tbody>';
            while($row = $stmt->fetch()){
                echo "<tr>
                <td>".$row['createAt']."</td>
                <td>".$row['firstName']." ".$row['middleName']." ".$row['lastName']." ".$row['suffix']."</td>
                <td>".$row['gender']."</td>
                <td>".$row['birthDate']."</td>
                <td>".$row['homeAddress']."</td>
                <td>".$row['contactNumber']."</td>
                <td><a class='btn btn-danger' href='?deativate_citizen=".$row['id']."'>Archive</a></td>
                <td><a class='btn btn-primary' href='editCitizen.php?edit_citizen=".$row['id']."'>Edit</a></td></td>
                <td><a class='btn btn-warning' href='identityCitizen.php?citizen_id=".$row['id']."'>View ID</a></td>
                </tr>";
            }
            echo "</tbody></table>";
        }else {
            echo "No Data Found";
        }
    }
    //DISPLAY DEACTIVED CITIZEN
    public function getdeactivatedCitizen(){ 
        $sql = "SELECT id, firstName, middleName, lastName, suffix, birthDate, gender, contactNumber, homeAddress, createAt FROM tb_citizen WHERE status = 'deactivated' ORDER BY tb_citizen.id DESC";
        $stmt = $this->connect()->query($sql);
        $rowCount = $stmt->rowCount();
        if($rowCount > 0){
            echo '<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped    display"
            width="100%">
            <thead>
                <tr>
                    <th>Date and Time</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Birth date</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th colspan="4">Action</th>
                </tr>
            </thead><tbody>';
            while($row = $stmt->fetch()){
                echo "<tr>
                <td>".$row['createAt']."</td>
                <td>".$row['firstName']." ".$row['middleName']." ".$row['lastName']." ".$row['suffix']."</td>
                <td>".$row['gender']."</td>
                <td>".$row['birthDate']."</td>
                <td>".$row['homeAddress']."</td>
                <td>".$row['contactNumber']."</td>
                <td><a class='btn btn-success' href='?active_citizen=".$row['id']."'>Retrive</a></td>
                </tr>";
            }
            echo "</tbody></table>";
        }else {
            echo "No Data Found";
        }
    }
    //DEACTIVED CITIZEN
    public function deativateCitizen($id){ 
        $sql = "SELECT * FROM tb_citizen WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $rowCount = $stmt->rowCount();
        $citizens = $stmt->fetchAll();
        if($rowCount > 0){
            foreach($citizens as $citizen){
                $_SESSION['status']=$citizen['status'];
            }
        }
        if ($_SESSION['status'] = 'active') {
            $status = 'deactivated';
            $sql = "UPDATE tb_citizen SET status= ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$status, $id]);
        }
            
    }
    //ACTIVATE CITIZEN
    public function activeCitizen($id){ 
        $sql = "SELECT * FROM tb_citizen WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $rowCount = $stmt->rowCount();
        $citizens = $stmt->fetchAll();
        if($rowCount > 0){
            foreach($citizens as $citizen){
                $_SESSION['status']=$citizen['status'];
            }
        }
        if ($_SESSION['status'] = 'deactivated') {
            $status = 'active';
            $sql = "UPDATE tb_citizen SET status= ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$status, $id]);
        }
    }
    //EDIT CITIZEN
    public function displayCitizentext($id){
        $sql = "SELECT * FROM tb_citizen WHERE id= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $citizens = $stmt->fetchAll();
        foreach ($citizens as $citizen) {
            echo'
            <form class="form-horizontal row-fluid" method="POST" action="">
                <div class="control-group">
                    <label class="control-label" for="Suffix">Suffix</label>
                    <div class="controls">
                        <input type="text" id="Suffix" name="suffix" value="'.$citizen['suffix'].'" placeholder="Suffix(e.g. Sr., Jr., II)" class="span8">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="First">First Name</label>
                    <div class="controls">
                        <input type="text" id="First" name="fname" value="'.$citizen['firstName'].'" placeholder="Enter First Name" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Middle">Middle Name</label>
                    <div class="controls">
                        <input type="text" id="Middle" name="mname" value="'.$citizen['middleName'].'" placeholder="Enter Middle Name" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Last">Last Name</label>
                    <div class="controls">
                        <input type="text" id="Last" name="lname" value="'.$citizen['lastName'].'" placeholder="Enter Last Name" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Birth">Birth Date</label>
                    <div class="controls">
                        <input type="date" id="Birth" name="bdate" value="'.$citizen['birthDate'].'" placeholder="Enter First Name" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="emailAdd">Email Address</label>
                    <div class="controls">
                        <input type="text" id="emailAdd" name="emailAddress" placeholder="Enter Email Address" class="span8" value="'.$citizen['emailAddress'].'" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="brgy">Brangay/Town/City</label>
                    <div class="controls">
                        <input id="brgy" type="text" name="address" value="'.$citizen['homeAddress'].'" placeholder="Enter Barangay" class="span8" required="">
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
                        <input id="contact1" name="cpnumber" value="'.$citizen['contactNumber'].'" type="text" onchange="valnumblenght();" onkeypress="isInputNumber(event);" placeholder="09XXXXXXXXX" class="span8" required="">
                        <span class="help-inline"><label id="lbltxt" class="text-danger"></label></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="username">Username</label>
                    <div class="controls">
                        <input id="username" type="text" name="username" value="'.$citizen['citizenUsername'].'" placeholder="Enter Username" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="pass">Password</label>
                    <div class="controls">
                        <input id="pass" type="password" name="password" value="" placeholder="Enter Password" class="span8"  required="">
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
                        <button name="submit" type="Submit" class="btn btn-success">Update Form</button>
                    </div>
                </div>
            </form>
            ';
        }
    }
    //UPDATE CITIZEN
    public function updateCitizen($fname, $mname, $lname, $suffix, $bdate, $gender, $cpnumber, $address, $username, $password, $role, $emailAddress, $createAt, $id){
     try{

        $sql = "UPDATE tb_citizen SET firstName=? ,middleName=? ,lastName=? ,suffix=? ,birthDate=? ,gender=? ,contactNumber=? ,homeAddress=? ,citizenUsername=? ,citizenPass=? ,role=? ,emailAddress=? ,createAt=? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fname, $mname, $lname, $suffix, $bdate, $gender, $cpnumber, $address, $username, $password, $role, $emailAddress, $createAt, $id]);
            if($stmt){
                echo '<script>
                    setTimeout(function () {
                        swal({
                            title: "Successfully!",
                            text: "Successfully Updated...",
                            type: "success",
                        },function(isConfirm) {	
                            if(isConfirm){						
                            window.location.href = "../admin/datatableCitizen.php?Status=Successfully";
                            }
                        });
                    },);
                </script>';
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }
    //DISPLAY HIGHTEMP
    public function getHightmp(){ 
        $sql = "SELECT tb_tracinglog.tracing_id, tb_citizen.firstName, tb_citizen.middleName, tb_citizen.lastName, tb_citizen.suffix, tb_citizen.homeAddress, tb_citizen.contactNumber, tb_establishment.businessName, tb_tracinglog.temperature, tb_tracinglog.tracingDateTime 
        FROM tb_tracinglog INNER JOIN tb_citizen ON tb_tracinglog.citizen_id = tb_citizen.id 
        INNER JOIN tb_establishment ON tb_tracinglog.estab_id = tb_establishment.id
        WHERE tb_tracinglog.temperature > 39
        ORDER BY tb_tracinglog.tracing_id DESC";
        $stmt = $this->connect()->query($sql);
        $rowCount = $stmt->rowCount();
        if($rowCount > 0){
            echo '<table cellpadding="0" cellspacing="0" border="0" id="myTable" class="table table-bordered table-striped"
            width="100%">
            <thead>
                <tr>
                    <th>Time and Date</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th>Establishment</th>
                    <th>Temperature</th>
                    <th>Edit</th>
                </tr>
            </thead><tbody>';
            while($row = $stmt->fetch()){
                echo "
                <td>".$row['tracingDateTime']."</td>
                <td>".$row['firstName']." ".$row['middleName']." ".$row['lastName']." ".$row['suffix']."</td>
                <td>".$row['homeAddress']."</td>
                <td>".$row['contactNumber']."</td>
                <td>".$row['businessName']."</td>
                <td>".$row['temperature']."</td>
                <td><a type='button' class='btn btn-primary' data-toggle='modal' data-book-id='1' data-target='#exampleModal'>Edit</a></td>
                </tr>";
            }
            echo "</tbody></table>";
        }else {
            echo "No Data Found";
        }
    }
    //PRINT QRCODE CITIZEN
    public function displayCitizeninfo($id){
        $sql = "SELECT * FROM tb_citizen WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
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
    //INSERT ADMIN
    public function insertAdmin($fname, $mname, $lname, $email, $cpnumber,$username, $password, $role){
        try {
            //code...
            date_default_timezone_set("Asia/Manila");
            $createAt = Date('Y-m-d H:i:sa');
            $sql = "INSERT INTO tb_admin (id, firstName, middleName, lastName, emailAddress, contactNumber, adminUsername, adminPass, role, createAt) VALUES (NULL , ? , ? , ? , ? , ?, ? , ? , ? , ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$fname, $mname, $lname, $email, $cpnumber,$username, $password, $role, $createAt]);
            echo '<script>
                    setTimeout(function () {
                        swal({
                            title: "Successfully!",
                            text: "Successfully registered new data...",
                            type: "success",
                        },function(isConfirm) {	
                            if(isConfirm){						
                            window.location.href = "../admin/addUserAdmin.php?Status=Successfully";
                            }
                        });
                    },);
                </script>';
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }
    //DISPALY ADMIN
    public function getAdmin(){ 
        $sql = "SELECT id, firstName, middleName, lastName, emailAddress, contactNumber, createAt FROM tb_admin ORDER BY tb_admin.createAt DESC";
        $stmt = $this->connect()->query($sql);
        $rowCount = $stmt->rowCount();
        if($rowCount > 0){
            echo '<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
            width="100%">
            <thead>
                <tr>
                    <th>Date and Time</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Contact No.</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead><tbody>';
            while($row = $stmt->fetch()){
                echo "<tr>
                <td>".$row['createAt']."</td>
                <td>".$row['firstName']." ".$row['middleName']." ".$row['lastName']."</td>
                <td>".$row['emailAddress']."</td>
                <td>".$row['contactNumber']."</td>
                <td><a class='btn btn-danger' href='?del_admin=".$row['id']."'>Delete</a></td>
                <td><a class='btn btn-primary' href='editAdmin.php?edit_admin=".$row['id']."'>Edit</a></td></td>
                </tr>";
            }
            echo "</tbody></table>";
        }else {
            echo "No Data Found";
        }
    }
    //DELETE ADMIN
    public function destroyAdmin($id){ 
        $sql = "DELETE FROM tb_admin WHERE id='$id'";
        $stmt = $this->connect()->query($sql);
    }
    //EDIT ADMIN
    public function displayAdmintext($id){
        $sql = "SELECT * FROM tb_admin WHERE id= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $admins = $stmt->fetchAll();
        foreach ($admins as $admin) {
            echo'
            <form class="form-horizontal row-fluid" method="POST" action="">
                <div class="control-group">
                    <label class="control-label" for="First">First Name</label>
                    <div class="controls">
                        <input type="text" id="First" name="fname" value="'.$admin['firstName'].'" placeholder="Enter First Name" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Middle">Middle Name</label>
                    <div class="controls">
                        <input type="text" id="Middle" name="mname" value="'.$admin['middleName'].'" placeholder="Enter Middle Name" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Last">Last Name</label>
                    <div class="controls">
                        <input type="text" id="Last" name="lname" value="'.$admin['lastName'].'" placeholder="Enter Last Name" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Email">Email Address</label>
                    <div class="controls">
                        <input type="email" id="Email" name="email" value="'.$admin['emailAddress'].'" placeholder="Enter Email" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="contact1">Cellphone</label>
                    <div class="controls">
                        <input id="contact1" name="cpnumber" value="'.$admin['contactNumber'].'" type="text" onchange="valnumblenght();" onkeypress="isInputNumber(event);" placeholder="09XXXXXXXXX" class="span8" required="">
                        <span class="help-inline"><label id="lbltxt" class="text-danger"></label></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="username">Username</label>
                    <div class="controls">
                        <input id="username" type="text" name="username" value="'.$admin['adminUsername'].'" placeholder="Enter Username" class="span8" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="pass">Password</label>
                    <div class="controls">
                        <input id="pass" type="password" name="password" value="" placeholder="Enter Password" class="span8"  required="">
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
                        <button name="submit" type="Submit" class="btn btn-success">Update Form</button>
                    </div>
                </div>
            </form>
            ';
        }
    }
    //UPDATE ADMIN
    public function updateAdmin($fname, $mname, $lname, $email, $cpnumber,$username, $password, $role, $createAt, $id){
        try{
        $sql = "UPDATE tb_admin SET firstName=? ,middleName=? ,lastName=? ,emailAddress=?, contactNumber=? ,adminUsername=? ,adminPass=? ,role=? ,createAt=? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fname, $mname, $lname, $email, $cpnumber,$username, $password, $role, $createAt, $id]);
        echo '<script>
                setTimeout(function () {
                    swal({
                        title: "Successfully!",
                        text: "Successfully Updated...",
                        type: "success",
                    },function(isConfirm) {	
                        if(isConfirm){						
                        window.location.href = "../admin/datatableAdmin.php?Status=Successfully";
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