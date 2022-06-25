<?php
include ('include/config.php');
//$e="em";
//echo '<script type="text/javascript">alert("' . $e . '")</script>';
extract($_REQUEST);

$name = $_GET['uname'];
$contact = $_GET['contact'];
//$address=$_GET['address'];
$email = $_GET['email'];
$type = $_GET['type'];
$msg = "hi";
$pid = $_GET['pid'];
/* $pass=$_GET['pass'];
$pass2=$_GET['pass2'];
$que=mysqli_query($con,"select * from users where email='$email'");	
$row=mysqli_num_rows($que);
*/
$err = "";
if ($name == "" or $contact == "" or $email == "" or $type == "") {
    $err = "All feilds should fill properly";
    echo '<script type="text/javascript">alert("' . $err . '")</script>';
    //header('location:User_registration.php');
    
}
/* if($pass2 != $pass)
{
	$err="password and conferm password should match";	
	echo '<script type="text/javascript">alert("' . $err . '")</script>';
	//header('location:User_registration.php');
	
}
if(strlen($contact)<10 or strlen($contact)>12 )
{
	
	$err="Mobile number not proper";
	echo '<script type="text/javascript">alert("' . $err . '")</script>';
	//header('location:User_registration.php');
	
}

*/
if (strlen($err) < 5) {
    $dt = date("Y/m/d");
    $que = mysqli_query($con, "INSERT INTO `inquiry`(`name`, `subject`, `email`, `mobile`, `message`, `date`, `propertyId`) VALUES ('$name','$type','$email','$contact','$msg','$dt','$pid')");
    //	$row=mysqli_num_rows($que);
    $msg = "Your Request Submited Successfully";
    echo '<script type="text/javascript">alert("' . $msg . '"); window.location.href = "index.php"; </script>';
    //sleep(1);
    //header('location:User_Login.php');
    
} else {
    $err = "somthing went wrong";
    //echo '<script type="text/javascript">alert("' . $err . '")</script>';
    echo '<script type="text/javascript">alert("' . $err . '"); window.location.href = "User_registration.php"; </script>';
    //header('location:User_registration.php');
    
}
?>