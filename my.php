<?php
$uname = $_POST['uname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$gender = $_POST['gender'];
$mob = $_POST['mob'];
$pin = $_POST['pin'];




if ( !empty($uname) || !empty($email) ||  !empty($pwd) || !empty($gender) || !empty($mob) || !empty($pin)) {
 $host = "localhost:3307";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "form";


    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (uname, email, pwd, gender, mob, pin) values(?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $uname, $email, $pwd, $gender, $mob, $pin );
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();

}

?>