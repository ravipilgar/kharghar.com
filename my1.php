<?php

session_start();



 $host = "localhost:3307";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "form";


    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

  if($conn)
  {
  	echo "connection sucessfull";
  }else{
  	echo "no conn";
  }

			$username = $_POST['email'];
			$pass = $_POST['pwd'];



    $q = " select * from register where email = '$username' && pwd = '$pass' ";

    	$result = mysqli_query($conn, $q);

    	$num = mysqli_num_rows($result);

    	if($num == 1){

    		$_SESSION['email'] = $username;
    		header('location:index.php');

    	}else{
      header('location:woman.html');
    }

?>