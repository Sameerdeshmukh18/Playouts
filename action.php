<?php
include ('include/config.php');
//$e="em";
//echo '<script type="text/javascript">alert("' . $e . '")</script>';
extract($_REQUEST);
if (isset($_POST['save'])) {
    $name    = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $email   = $_POST['email'];
    $age     = $_POST['age'];
    $pass    = $_POST['pass'];
    $pass2   = $_POST['pass2'];

    $que = mysqli_query($con, "select * from users where email='$email'");
    $row = mysqli_num_rows($que);
	$err = "";
	
    if ($row > 0) {
        $err = "email already registered..try another";
        echo '<script type="text/javascript">alert("' . $err . '")</script>';
        //header('location:User_registration.php');
        
    }
    if ($name == "" or $contact == "" or $address == "" or $email == "" or $pass == "" or $age == "") {
        $err = "All fields shoud be filled properly";
        echo '<script type="text/javascript">alert("' . $err . '")</script>';
        //header('location:User_registration.php');
        
    }
    if ($pass2 != $pass) {
        $err = "password and conferm password should match";
        echo '<script type="text/javascript">alert("' . $err . '")</script>';
        //header('location:User_registration.php');
        
    }
    if (strlen($contact) < 10 or strlen($contact) > 12 OR intval($contact) < 0) {
        $err = "Mobile number not proper";
        echo '<script type="text/javascript">alert("' . $err . '")</script>';
        //header('location:User_registration.php');
        
    }
    if (strlen($err) < 5) {

        $que = mysqli_query($con, "INSERT INTO `users`(`name`, `contact`, `email`, `address`, `password`,`player_age`, `user_type` ) VALUES ('$name','$contact','$email','$address','$pass','$age', 1)");
        // $row = mysqli_num_rows($que);
        $msg = "Registration Successful you can login now";

        if(!$que) {
            die(mysqli_error($con));
        }



        echo '<script type="text/javascript">alert("' . $msg . '"); window.location.href = "Player_Login.php"; </script>';
        //sleep(1);
        //header('location:User_Login.php');
        
    } else {
        $err = "somthing went wrong";
        //echo '<script type="text/javascript">alert("' . $err . '")</script>';
        echo '<script type="text/javascript">alert("' . $err . '"); window.location.href = "Player_registration.php"; </script>';
        //header('location:User_registration.php');
        
    }
} else {
    $e = "em";
    echo '<script type="text/javascript">alert("' . $e . '")</script>';
}
?>