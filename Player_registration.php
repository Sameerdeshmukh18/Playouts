<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Player Registration</title>
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
              </svg>  Player Registration</div>	
            <div class="card-body">
              <form method="post"  action="action.php">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input class="form-control" id="exampleInputEmail1" name="name" required type="text" aria-describedby="emailHelp" placeholder="Enter name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Contact No.</label>
                  <input class="form-control" id="exampleInputEmail1" name="contact"  maxlength="10"  aria-describedby="emailHelp" placeholder="Enter contact">
                </div>
                           
                <div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <input class="form-control" id="exampleInputEmail1" name="address" required type="text" aria-describedby="emailHelp" placeholder="Enter adress">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input class="form-control" id="exampleInputEmail1" name="email" required type="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Age</label>
                  <input class="form-control" id="exampleInputEmail1" name="age" required type="number" maxlength="2" aria-describedby="emailHelp" placeholder="Enter age">
                </div>
                <!-- <p>Intrested For:</p> -->
                <!-- <div class="form-group">
                  <input type="radio" name="type" value="Buy"> Football
                  <input type="radio" name="type" value="Rent"> Cricket
                  <input type="radio" name="type" value="Both"> Badminton
                </div> -->
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input class="form-control" id="exampleInputPassword1" name="pass" required type="password" placeholder="Password">
                </div>
                  
               <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input class="form-control" id="exampleInputPassword1" name="pass2" required type="password" placeholder="Password">
                </div>
                  
                <input class="btn btn-primary btn-block" type="submit" value="Register" name="save"/>
                </br>
                 <a class="nav-link dropdown-toggle" href="Player_Login.php">Exsiting User? Sign in</a>
              </form>
              
            </div>
          </div>
        </div>
       
        <script src="admin/assets/vendor/jquery/jquery.min.js"></script>
        <script src="admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
       
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