<?php 

include ('include/config.php');
session_start();

if(isset($_POST['save']))
{
     $email      = $_POST['email'];
     $password   = $_POST['pass'];

     $que    = mysqli_query($con,"select * from users where email='$email' && password='$password' && user_type=2 ");
     $result = mysqli_fetch_array($que);	

      // echo "<pre>";
      // print_r($result);
      // exit;
     $row    = mysqli_num_rows($que);

     if($row)
     {
          $_SESSION['email']      =  $email;
          $_SESSION['user_id']    =  $result['id'];
          $_SESSION['uname']      =  $result['name'];
          $_SESSION['email']      =  $result['email'];
          $_SESSION['contact']    =  $result['contact'];
          $_SESSION['user_type']  =  $result['user_type'];
           
        header('location:booking_details.php');
     }	
     else
     {
           $err="Pls Enter Valid Email or Password";
           echo '<script type="text/javascript">alert("Wrong Email or Password"); </script>';
     
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
  <title>Login</title>
  <!-- Bootstrap core CSS-->
  <link href="admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="admin/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="admin/assets/css/sb-admin.css" rel="stylesheet">

  
  
</head>

<body class="bg-white">

 
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header text-center"> 
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 14 14">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
          </svg> Turf Owner Login</div>
      <div class="card-body">
        <form method="post"  >

		   		  
		  <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" name="email" required type="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
		  
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" name="pass" required type="password" placeholder="Password">
          </div>
			
			
		  <input class="btn btn-primary btn-block" type="submit" value="Login" name="save"/>
		  </br>
		   <a class="nav-link dropdown-toggle" href="Turf_Owner_Registration.php">New Turf Owner? Sign up</a></br>
       
		   <!-- <a class="nav-link dropdown-toggle" href="Forget_Pwd.html">Forget Password</a> -->
		
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
