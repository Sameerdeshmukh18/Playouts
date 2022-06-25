<?php 

include ('include/config.php');
session_start();

if(isset($_POST['createBooking']))
{
    $turf_id    = $_POST['turf_id'];
    $player_id  = $_POST['player_id'];
    $team_id    = $_POST['team_id'];
    $team_name  = $_POST['team_name'];
    $booking_date  = $_POST['booking_date'];
    $booking_time  = $_POST['booking_time'];
    $closing_time  = $_POST['closing_time'];
    $booking_payment  = $_POST['booking_payment'];

    $getTurfOwner  = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM turf WHERE id='$turf_id' "));
    $ownerId       = $getTurfOwner['turf_owner_id'];
    $turfName      = $getTurfOwner['turf_name'];

    $getownerName  = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE id='$ownerId' "));
    $ownerName     = $getownerName['name'];


    $playerName  = $_SESSION['uname'];

    $insert  = mysqli_query($con, "INSERT INTO booking_details(player_id,  team_id, turf_id, turf_owner_id, booking_date, booking_time,closing_time,player_name,team_name,turf_name,turf_owner_name, booking_payment) 
               VALUES('$player_id', '$team_id', '$turf_id', '$ownerId', '$booking_date', '$booking_time', '$closing_time', '$playerName', '$team_name', '$turfName', '$ownerName', '$booking_payment')  " );

    if(!$insert) {
        mysqli_error($con);
    }           

    






}

?>
<?php
require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
      <link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" >
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />

      <title>Turf Booking System </title>
      <style>

.card {
  background: #222;
  border: 1px solid #dd2476;
  color: rgba(250, 250, 250, 0.8);
  margin-bottom: 2rem;
}
      </style>
   </head>
   <body>
      <nav>
         <div class="logo-name">
            <div class="logo-image">
               <img src="Logo.PNG" alt="">
            </div>
            <span class="logo_name">Turf Booking</span>
         </div>
         <div class="menu-items">
            <?php include('include/sidebar.php');  ?>
         </div>
      </nav>
      <section class="dashboard">
         <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <img src="images/profile.png" alt="">
         </div>
         <div class="dash-content">
            <div class="overview">
               <div class="title">
                  <i class="uil uil-football"></i>
                  <span class="text">Turfs</span>
                  <?php  if(isset($_SESSION['user_id']) && ($_SESSION['user_type'] == 1 )) { 
                     ?>
                        <button class="btn btn-primary ml-4" data-toggle="modal" data-target="#exampleModal">Book Turf</button>
                     <?php
                  } else {
                    ?>
                        
                    <?php
                  }  
                  ?>
               </div>

               <div class="row">

               <?php  $turfQuery = mysqli_query($con, "SELECT * FROM turf "); 
                         while ($turfs     = mysqli_fetch_assoc($turfQuery)) {
                             # code...
                             ?>

                   <div class="col-4">
                   <div class="card" style="width: 18rem;">
                    <img src="images/Turfs/<?= $turfs['turf_image'] ?>" height="190px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $turfs['turf_name'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $turfs['turf_location'] ?></h6>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        <!-- <a href="#" class="btn mr-2"><i class="fas fa-link"></i> Visit Site</a> -->
                        <!-- <a href="#" class="btn "><i class="fab fa-github"></i> Github</a> -->
                    </div>
                    </div>
                   </div>

                   <?php
                         }      ?> 
                      
               </div>


               
            </div>

            <!-- <div class="activity">
               <div class="title">
                  <i class="uil uil-clock-three"></i>
                  <span class="text">Recent Games</span>
               </div>
               <div class="activity-data">
                  <div class="data names">
                     <span class="data-title">Opponent Team</span>
                     <span class="data-list">Soul</span>
                     <span class="data-list">Godlike</span>
                     <span class="data-list">Liverpool</span>
                     <span class="data-list">8bit</span>
                     <span class="data-list">Orangerock</span>
                     <span class="data-list">Falcons</span>
                     <span class="data-list">Slytherin</span>
                  </div>
                  <div class="data email">
                     <span class="data-title">Turf Name</span>
                     <span class="data-list">Penalty corner</span>
                     <span class="data-list">Penalty corner</span>
                     <span class="data-list">Penalty corner</span>
                     <span class="data-list">Penalty corner</span>
                     <span class="data-list">Penalty corner</span>
                     <span class="data-list">Penalty corner</span>
                     <span class="data-list">Penalty corner</span>
                  </div>
                  <div class="data joined">
                     <span class="data-title">Date</span>
                     <span class="data-list">2022-02-12</span>
                     <span class="data-list">2022-02-12</span>
                     <span class="data-list">2022-02-13</span>
                     <span class="data-list">2022-02-13</span>
                     <span class="data-list">2022-02-14</span>
                     <span class="data-list">2022-02-14</span>
                     <span class="data-list">2022-02-15</span>
                  </div>
                  <div class="data type">
                     <span class="data-title">Game</span>
                     <span class="data-list">Football</span>
                     <span class="data-list">Cricket</span>
                     <span class="data-list">Football</span>
                     <span class="data-list">Cricket</span>
                     <span class="data-list">Football</span>
                     <span class="data-list">Cricket</span>
                     <span class="data-list">Football</span>
                  </div>
                  <div class="data status">
                     <span class="data-title">Result</span>
                     <span class="data-list">Won</span>
                     <span class="data-list">Lost</span>
                     <span class="data-list">Won</span>
                     <span class="data-list">Lost</span>
                     <span class="data-list">Won</span>
                     <span class="data-list">Lost</span>
                     <span class="data-list">Won</span>
                  </div>
               </div>
            </div>
             -->
         </div>

         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Player</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="post">
                    <?php  $isTeamExist   = (mysqli_query($con, "SELECT * FROM teams WHERE team_leader_id='".$_SESSION['user_id']."'  "));
                            $numRows       = mysqli_num_rows($isTeamExist);
                            $teamd         = mysqli_fetch_assoc($isTeamExist); 
                    ?> 

                         <div class="form-group">
                            <label for="">Choose Turf</label>
                            <select name="turf_id" class="form-control" id="" required>
                                <option value="">Choose Turf</option>
                                <?php  $turfQuery = mysqli_query($con, "SELECT * FROM turf"); 
                                        while ($turfs = mysqli_fetch_assoc($turfQuery) ) {
                                            # code...
                                            ?>
                                               <option value="<?= $turfs['id'] ?>"> <?= $turfs['turf_name'] ?> </option>
                                            <?php
                                        } ?>
                            </select>
                         </div>
                         <div class="form-group">
                            <label for="">Booking date</label>
                            <input type="hidden" name="player_id" value="<?= $_SESSION['user_id'] ?>">
                            <input type="hidden" name="team_id" value="<?= $teamd['id'] ?>">
                            <input type="hidden" name="team_name" value="<?= $teamd['team_name'] ?>">
                            
                            <input type="date" name="booking_date" class="form-control" required> 
                         </div>
                         <div class="form-group">
                            <label for="">Match Start Time</label>
                            <input type="time" name="booking_time" class="form-control" required> 
                         </div>
                         <div class="form-group">
                             <label for="">Match End Time</label>
                             <input type="time" name="closing_time" class="form-control" required>
                         </div>
                         <div class="form-group">
                             <label for="">Booking Payment(INR) </label>
                             <input type="text" name="booking_payment" class="form-control" value="500" readonly>
                          </div>
                         <input type="hidden" name="teamId" value="<?= $teamd['id'] ?>">
                         <div class="form-group">
                             <button class="btn btn-primary" name="createBooking">Submit</button>
                         </div>

                         <form action="submit.php" method="post" name="createBooking">
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button" 
		data-key="<?php echo $publishableKey?>"
		data-amount="50000"
		data-name="Playout Payment"
		data-description="Playout order Checkout"
		data-image="Logo.PNG"
		data-currency="inr"
		data-email="sameerdeshmukh827@gmail.com"
	>
	</script>

</form>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
                </div>
            </div>
            </div>
      </section>
        <script src="script.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

   </body>
</html>