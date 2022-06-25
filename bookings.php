<?php 

include ('include/config.php');
session_start();

if(isset($_POST['submit']))
{
    $teamName  = $_POST['team_name'];
    $team_leader_id     = $_POST['team_leader_id'];
   


    $insert  = mysqli_query($con, "INSERT INTO teams (team_name, team_leader_id) VALUES ('$teamName', '$team_leader_id') ");

    if($insert) {

    } else {
        mysqli_error($con);
    }
}

if(isset($_POST['createPlayer']))
{
    $playerName  = $_POST['name'];
    $contact     = $_POST['contact'];
    $playerAge   = $_POST['player_age'];
    $teamId      = $_POST['teamId'];


    $insert  = mysqli_query($con, "INSERT INTO users (`name`, `contact`, `player_age`, `team_id`,`user_type`) VALUES ('$playerName', '$contact', '$playerAge', '$teamId', 1) ");

    if($insert) {

    } else {
        mysqli_error($con);
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

            <?php  if($numRows) {
                   ?>

                <div class="title">
                  <i class="uil uil-football"></i>
                  <span class="text"><?= $teamd['team_name']  ?></span>
               </div>

               <h5>Bookings of <?= $teamd['team_name'] ?></h5>

                    <div class="row">
                          <div class="col-lg-12 table-responsive" >
                              <table class="table  table-bordered" style="max-width:100%">
                                  <thead>
                                      <th>Sr. No</th>
                                      <th>Team Name</th>
                                      <th>Turf Name</th>
                                      <th>Booking Time</th>
                                      <th>Start Time</th>
                                      <th>End Time</th>
                                      
                                  </thead>
                                  <tbody>
                                    <?php $bookingQuery  = mysqli_query($con, "SELECT * FROM booking_details WHERE team_id='".$teamd['id']."' "); 
                                           $count = 1;
                                           while ($bookings  = mysqli_fetch_assoc($bookingQuery) ) {
                                               # code...
                                               ?>

                                            <tr>
                                                <td> <?= $count++; ?> </td>
                                                <td> <?= $bookings['team_name']  ?> </td>
                                                <td> <?= $bookings['turf_name'] ?> </td>
                                                <td> <?= $bookings['booking_date'] ?> </td>
                                                <td> <?= $bookings['booking_time'] ?> </td>
                                                <td> <?= $bookings['closing_time'] ?> </td>
                                            </tr>
                                               
                                               <?php
                                           } ?>  
                                     
                                        
                                      
                                      
                                  </tbody>
                              </table>
                          </div>
                    </div>
                   
                   
                   <?php
            } else {

                ?>

                <div class="title">
                  <i class="uil uil-football"></i>
                  <span class="text">Create Team</span>
               </div>

                    <div class="row">
                        <div class="col-md-4">
                        <form action="create-team.php" method="POST">
                       <div class="form-group">
                           <label for="">Enter Team Name</label>
                           <input type="text" class="form-control" name="team_name">
                           <input type="hidden" name="team_leader_id" value="<?= $_SESSION['user_id'] ?>">
                       </div>
                       <div class="form-group">
                           <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                       </div>
                   </form>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                    </div>
                
                
                <?php
            } ?>
               
                   
                  
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