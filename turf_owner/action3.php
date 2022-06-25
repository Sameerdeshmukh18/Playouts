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

