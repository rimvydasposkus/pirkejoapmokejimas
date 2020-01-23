<?php
require 'dbh.inc.php' ;
  if(isset($_POST['delete_user'])) {

    $userId = $_POST['userId'];
    if(empty($userId)){
      header("Location: ../delete.php?error=emptyfields");
      exit();
    }
    else{
      $sql = "SELECT ID FROM users WHERE ID = ?";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../delete.php?errors=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt,"i",$userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if($resultCheck == 0) {
          header("Location: ../delete.php?errors=nousers");
          exit();
        }else {
          $sql = "DELETE FROM users WHERE  ID=?";
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../delete.php?errors=sqlerror");
            exit();
          }
          else{
            mysqli_stmt_bind_param($stmt,'i',$userId);
            mysqli_stmt_execute($stmt);
            header("Location: ../adminpanel.php?success");
            exit();
        }
      }
      }
      }
    }
    else {
      header("Location: ../delete.php");
      exit();
    }
  ?>
