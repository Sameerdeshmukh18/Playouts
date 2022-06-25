<?php 
   include ('include/config.php');
   session_start();
   if(isset($_POST['addScore'])) {

      $challengeId    = $_POST['challengeId'];
      $opponent_team  = $_POST['opponent_team'];
      $self_team      = $_POST['self_team'];
      
      $updateQuery  = mysqli_query($con,  "UPDATE challenges set self_team_score='".$self_team."', opponent_score='".$opponent_team."' WHERE id='".$challengeId."' ");
      
      if($updateQuery) {
         echo "<script>alert('Score updated successfully'); window.reload(); </script>";
      } else {
         echo "<script>Something went wrong.</script>";
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
                  <span class="text"> Challenges Created By You </span>
               </div>
               <div class="row">
                    <?php   $challengeQuery   =  mysqli_query($con, "SELECT * FROM  challenges WHERE team_leader_id_creating= '".$_SESSION['user_id']."' " );
                            while ($challenges  = mysqli_fetch_assoc($challengeQuery)) {
                                # code...

                                ?>
                                <div class="col-lg-6">
                                    <div class="card"style="width: 80%;" >
                                        <img class="card-img-top" class="image-flex" src="images/challenge1.jpeg" alt="Card image cap" style="width: 100%; height: 14vw; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $challenges['challenge_name'] ?></h5>
                                            <p class="card-text"> <?= $challenges['details'] ?>  </p>
                                            <p class=""><strong>Date :</strong> <?= $challenges['booking_date'] ?> <strong>Time : </strong><?= $challenges['starting_date'] ?>-<strong></strong><?= $challenges['ending_date'] ?> </p>

                                            <?php  $turfname  =  mysqli_fetch_array(mysqli_query($con, "SELECT * FROM turf WHERE id='".$challenges['turf_id']."'  "));  ?>
                                 
                                            <p class=""><strong> Match Venue : </strong><?=$turfname['turf_name']  ?>, <?=$turfname['turf_location']  ?>  </p>
                                            <?php  $teamrating= mysqli_fetch_array(mysqli_query($con, "SELECT * FROM teams WHERE id='".$challenges['team_id_creating']."'  "));?>
                                            <p class=""><strong> Rating:</strong> <?=$teamrating['teamRating']  ?>  </p>




                                            <?php  if($challenges['team_id_accepting']) {
                                                 ?>
                                                    <button class="btn btn-success">Accepted</button>
                                                    <?php  $acceptingTeam  =  mysqli_fetch_array(mysqli_query($con, "SELECT * FROM teams WHERE id='".$challenges['team_id_accepting']."'  "));  ?>
                                                    Accepted By <?= $acceptingTeam['team_name'] ?> 

                                                    <?php  if($challenges['self_team_score']) {
                                                       ?>
                                                       
                                                       <hr>
                                                       <p>Match Finished</p>
                                                        <strong> <?= $teamd['team_name'] ?> </strong> Score : <?= $challenges['self_team_score'] ?> <br>
                                                       <?php   $opponentTeam = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM teams WHERE id='".$challenges['team_id_accepting']."'  "));

                                                      ?>
                                                        <strong> <?= $opponentTeam['team_name'] ?> </strong> Score : <?= $challenges['opponent_score'] ?>
                                                        <br>

                                                       <?php if($challenges['self_team_score'] > $challenges['opponent_score']) {
                                                         $updateQuery  = mysqli_query($con,  "UPDATE teams set teamRating=teamRating -5 where id='".$challenges['team_id_accepting']."' ");
                                                         $updateQuery  = mysqli_query($con,  "UPDATE teams set teamRating=teamRating +10 where id='".$challenges['team_id_creating']."' ");
                                                              echo "Team <strong>".$teamd['team_name']."</strong> has won";
                                                              

                                                       } else {
                                                          ?>
                                                                <strong> <?= $opponentTeam['team_name'] ?> </strong> has won.
                                                          <?php
                                                           $updateQuery  = mysqli_query($con,  "UPDATE teams set teamRating=teamRating -5 where id='".$challenges['team_id_creating']."' ");
                                                           $updateQuery  = mysqli_query($con,  "UPDATE teams set teamRating=teamRating +10 where id='".$challenges['team_id_accepting']."' ");
                                                           
                                                       } ?>
                                                       
                                                       <?php
                                                    } else {
                                                       ?>
                                                       <br>
                                                         <button  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mt-2">Add Score</button>

                                                       <?php
                                                    }    ?>




                                                 <?php
                                            } else {
                                                ?>
                                                <button class="btn btn-secondary"> Not Accepted Yet</button>
                                                <?php
                                            } ?>

                                        </div>
                                    </div>
                                </div>

                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Add Score</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                              </div>
                              <div class="modal-body">
                                   <form action="created-challenge.php" method="post">
                                        <div class="form-group">
                                             <label for="">Score For <?= $teamd['team_name'] ?> </label>
                                             <input type="number" min="1" name="self_team"  class="form-control" required>
                                             <input type="hidden" name="challengeId" value="<?= $challenges['id'] ?>">
                                        </div>
                                        <div class="form-group">
                                          <?php   $opponentTeam = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM teams WHERE id='".$challenges['team_id_accepting']."'  "));

                                          ?>
                                             <label for="">Score for <?= $opponentTeam['team_name'] ?></label>
                                             <input type="number"  min="1" name="opponent_team" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                             <button type="submit" name="addScore"  class="btn btn-primary">Submit</button>
                                        </div>
                                   </form>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>


                                
                               
                            <?php
                      
                  }  ?>
                  
               </div>
            </div>

            <div class="overview">
               <div class="title">
                  <i class="uil uil-football"></i>
                  <span class="text"> Challenges Created By Other Teams </span>
               </div>
               <div class="row">
                    <?php   $challengeQuery   =  mysqli_query($con, "SELECT * FROM  challenges WHERE team_leader_id_creating != '".$_SESSION['user_id']."' " );
                            while ($challenges  = mysqli_fetch_assoc($challengeQuery)) {
                                # code...

                                ?>
                                <div class="col-lg-6" >
                                    <div class="card" style="width: 80%;">
                                        <img class="card-img-top" class="image-flex" src="images/challenge.jpeg" alt="Card image cap" style="width: 100%; height: 14vw; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $challenges['challenge_name'] ?></h5>
                                            <p class="card-text"> <?= $challenges['details'] ?>  </p>

                                            <?php  $turfname3  =  mysqli_fetch_array(mysqli_query($con, "SELECT * FROM turf WHERE id='".$challenges['turf_id']."'  ")); ?>


                                            <p class=""><strong>Date :</strong> <?= $challenges['booking_date'] ?> </p>
                                            <p class="">  <strong> Time : </strong><?= $challenges['starting_date'] ?> - <?= $challenges['ending_date'] ?> </p>
                                            <p class=""> <strong>Match Venue : </strong><?= $turfname3['turf_name']?>, <?= $turfname3['turf_location']?></p>

                                           <?php $opteam = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM teams WHERE id='".$challenges['team_id_creating']."'  ")); ?>


                                           <p class=""><strong>Team Rating :</strong> <?= $opteam['teamRating'] ?> </p>

                                            <?php  if($challenges['team_id_accepting'] && ($challenges['team_id_accepting'] == $teamd['id'] ) ) {
                                                 ?>
                                                  <button class="btn btn-success">Accepted by You</button>
                                                 <?php
                                            } else {
                                                 
                                                 if($challenges['team_id_accepting']) {

                                                   ?>
                                                       <button class="btn btn-success">Accepted</button>
                                                   <?php
                                                 } else {
                                                    ?>
                                                      <a class="btn btn-success" href="accept-challenge.php?challenge_id=<?= $challenges['id'] ?>" >Accept ? </a>

                                                    <?php
                                                 }
                                                ?>
                                                <?php
                                            } ?>

                                        </div>
                                    </div>
                                </div>
                                
                                
                               <?php
                             }  ?>
                  
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