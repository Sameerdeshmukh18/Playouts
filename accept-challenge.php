<?php

session_start();
include "include/config.php";

if($_GET['challenge_id']) 
{
    $challengeId   =  $_GET['challenge_id'];
    $userId        =  $_SESSION['user_id'];

    $teamDetails   = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM teams WHERE team_leader_id= '$userId' "));


    if(!$teamDetails) {
        echo "<script>alert('Please create team first... !'); window.location='create-team.php' </script>";
        // header('location:');

    } else {

        $teamId  = $teamDetails['id'];

        $updateQuery   = mysqli_query($con, "UPDATE challenges set team_id_accepting='$teamId', team_leader_id_accepting='$userId' WHERE id='$challengeId' " );

        if($updateQuery) {
            echo "<script>alert('Challenge accepted successfully'); window.location='create-team.php' </script>";

        } else {
            echo "<script>alert('Something went wrong...!'); window.location='created-challenge.php' </script>";

        }


    }



}





?>