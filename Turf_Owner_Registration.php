<?php 

include ('include/config.php');


if(isset($_POST['save']))
{
    $name    = $_POST['name'];
    $contact = $_POST['contact'];
    $email   = $_POST['email'];
    $pass    = $_POST['pass'];
    $pass2   = $_POST['pass2'];

    // turf details 
    $turf_name      = $_POST['turf_name'];
    $turf_location  = $_POST['turf_location'];
    $turf_image     = $_POST['turf_image'];

    $banner        = $_FILES['turf_image']['name']; 
    $expbanner     = explode('.',$banner);
    $bannerexptype = $expbanner[1];
    
    $date          = date('m/d/Yh:i:sa', time());
    $rand          = rand(10000,99999);
    $encname       = $date.$rand;
    $bannername    = md5($encname).'.'.$bannerexptype;
    $bannerpath    = "images/Turfs/".$bannername;
    move_uploaded_file($_FILES["turf_image"]["tmp_name"],$bannerpath);


    // exit;

    $que = mysqli_query($con, "select * from users where email='$email'");
    $row = mysqli_num_rows($que);
    $err = "";
	
    if ($row > 0) {
        $err = "email already registered..try another";
        echo '<script type="text/javascript">alert("' . $err . '")</script>';
        //header('location:User_registration.php');
        
    }
    if ($name == "" or $contact == ""  or $email == "" or $pass == "" or $turf_name == "" ) {
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

        $que     =   mysqli_query($con, "INSERT INTO `users`(`name`, `contact`, `email`, `password`, `user_type` ) VALUES ('$name','$contact','$email','$pass', 2)");
        $msg     =   "Registration Successful you can login now";

        $turfOwnerId   = mysqli_insert_id($con);

        $insertTurf   =  mysqli_query($con, "INSERT INTO `turf` (`turf_name`, `turf_location`, `turf_image`, `turf_owner_id`) VALUES ('$turf_name', '$turf_location', '$bannername', '$turfOwnerId' )   ");

        if(!$que) {
            die(mysqli_error($con));
        }

        if(!$insertTurf) {
          die(mysqli_error($con));
        }



        echo '<script type="text/javascript">alert("' . $msg . '"); window.location.href = "Turf_owner_Login.php"; </script>';
        //sleep(1);
        //header('location:User_Login.php');
        
    } else {
        $err = "somthing went wrong";
        //echo '<script type="text/javascript">alert("' . $err . '")</script>';
        echo '<script type="text/javascript">alert("' . $err . '"); window.location.href = "Turf_Owner_Registration.php"; </script>';
        //header('location:User_registration.php');
        
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Turf Owner Registration</title>
    <!-- Bootstrap core CSS-->
    <link href="admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="admin/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="admin/assets/css/sb-admin.css" rel="stylesheet">
  
</head>
<body>
    <body class="bg-light">

 
        <div class="container">
          <div class="card card-login mx-auto mt-5">
            <div class="card-header text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 14 14">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                  </svg> Turf Owner Registration</div>	
            <div class="card-body">
              <form method="post"  action="Turf_Owner_Registration.php" enctype="multipart/form-data">
                <h5>Turf Owner Details</h5>
                <hr>
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input class="form-control" id="exampleInputEmail1" name="name" required type="text" aria-describedby="emailHelp" placeholder="Enter name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Contact No.</label>
                  <input class="form-control" id="exampleInputEmail1" name="contact" required type="number" maxlength="10"  aria-describedby="emailHelp" placeholder="Enter contact">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input class="form-control" id="exampleInputEmail1" name="email" required type="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input class="form-control" id="exampleInputPassword1" name="pass" required type="password" placeholder="Password">
                </div>
                  
               <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input class="form-control" id="exampleInputPassword1" name="pass2" required type="password" placeholder="Password">
                </div>

                <h5>Turf Details</h5>
                <hr>

                <div class="form-group">
                  <label for="exampleInputEmail1">Turf Name</label>
                  <input class="form-control" id="exampleInputEmail1" name="turf_name" required type="text" aria-describedby="emailHelp" placeholder="Enter name">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Address Of Turf</label>
                  <input class="form-control" id="exampleInputEmail1" name="turf_location" required type="text" aria-describedby="emailHelp" placeholder="Enter adress">
                </div>

                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Turf Images</label>
                    <input class="form-control" required  name="turf_image" type="file">
                </div>


                  
                <input class="btn btn-primary btn-block" type="submit" value="Register" name="save"/>
                </br>
                 <a class="nav-link dropdown-toggle" href="Turf_owner_Login.php">Exsiting User? Sign in</a>
              </form>
              
            </div>
          </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="admin/assets/vendor/jquery/jquery.min.js"></script>
        <script src="admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="admin/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
        
       
    
</body>
<style>
    .card-header{
      background-color:blueviolet;
    }
    .btn{
      background-color: blueviolet;
    }
  </style>
</html>