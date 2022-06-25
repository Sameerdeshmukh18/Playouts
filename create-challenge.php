<?php 

include ('include/config.php');
session_start();

if(isset($_POST['createChallenge']))
{
    $challenge_name           = $_POST['challenge_name'];
    $team_id_creating         = $_POST['team_id_creating'];
    $team_leader_id_creating  = $_POST['team_leader_id_creating'];
    $game                     = $_POST['game'];
    $turf_id                  = $_POST['turf_id'];
    $booking_date           = $_POST['challenge_date'];
    $start_time               = $_POST['start_time'];
    $end_date             = $_POST['end_time'];

    $details  = $_POST['details'];

    $insert  = mysqli_query($con, "INSERT INTO challenges (game_name, challenge_name, details, team_id_creating, team_leader_id_creating,turf_id,booking_date, starting_date, ending_date ) 
                                  VALUES ('$game', '$challenge_name', '$details', '$team_id_creating', '$team_leader_id_creating','$turf_id', '$booking_date', '$start_time', '$end_date' ) ");

    if($insert) {

    } else {
        die(mysqli_error($con));
    }
}



?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />

      <title>Turf Booking System </title>
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

         <div class="dash-content" >
            <?php  $isTeamExist   = (mysqli_query($con, "SELECT * FROM teams WHERE team_leader_id='".$_SESSION['user_id']."'  "));
                   $numRows       = mysqli_num_rows($isTeamExist);
                   $teamd         = mysqli_fetch_assoc($isTeamExist); 
          ?> 

            <div class="overview">


                <div class="title">
                  <i class="uil uil-football"></i>
                  <span class="text"> Create Challenge </span>
               </div>


                    <div class="row">
                           <div class="col-lg-3"></div>
                          <div class="col-lg-6 " >
                              <form action="create-challenge.php" method="post">
                                  <div class="form-group">
                                      <label for="">Challenge Name</label>
                                      <input type="text" name="challenge_name" class="form-control" required>
                                      <input type="hidden" name="team_id_creating" value="<?= $teamd['id'] ?>">
                                      <input type="hidden" name="team_leader_id_creating" value=" <?= $_SESSION['user_id'] ?> " >
                                  </div>
                                  <div class="form-group">
                                      <label for="">Team Rating</label>
                                      <input type="text" value="<?= $teamd['teamRating'] ?>" required  class="form-control" name="team_name" readonly>
                                      <!-- <textarea name="details" class="form-control" required  id="" cols="10" rows="5"></textarea> -->
                                  </div>
                                  <div class="form-group">
                                      <label for="">Choose Game</label>
                                      <select name="game" id="" class="form-control" required>
                                          <option value="">Choose Game</option>
                                          <option value="Cricket">Cricket</option>
                                          <option value="Football">Football</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label for="">Choose Turf</label>
                                      <select name="turf_id" id="" class="form-control" required>
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
                                      <label for="">Your Team</label>
                                      <input type="text" value="<?= $teamd['team_name'] ?>" required  class="form-control" name="team_name" readonly>
                                  </div>
                                  <div class="form-group">
                                      <label for="">Challege Date</label>
                                      <input type="date" name="challenge_date" required class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label for="">Start Time</label>
                                      <input type="time" name="start_time" id="" required class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label for="">End Time</label>
                                      <input type="time" name="end_time" required class="form-control" > 
                                  </div>
                                  <div class="form-group">
                                      <button type="submit" name="createChallenge" class="btn btn-primary">Submit</button>
                                  </div>
                              </form>
                          </div>
                          <div class="col-lg-3"></div>

                    </div>

                   
                   
               
                  
            </div>
            
         </div>
         <!-- Modal -->
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
                    <form action="create-team.php" method="post">
                         <div class="form-group">
                            <label for="">Enter Player Name</label>
                            <input type="text" name="name" class="form-control"> 
                         </div>
                         <div class="form-group">
                            <label for="">Enter Player Age</label>
                            <input type="text" name="contact" class="form-control"> 
                         </div>
                         <div class="form-group">
                            <label for="">Enter Player Contact</label>
                            <input type="text" name="player_age" class="form-control"> 
                         </div>
                         <input type="hidden" name="teamId" value="<?= $teamd['id'] ?>">

                         <div class="form-group">
                             <button class="btn btn-primary" name="createPlayer">Submit</button>
                         </div>

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