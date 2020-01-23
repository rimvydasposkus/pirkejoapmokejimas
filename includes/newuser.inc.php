<?php

require 'dbh.inc.php' ;
  if(isset($_POST['add_user'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['repeatpsw'];

    if(empty($username) || empty($password) || empty($passwordRepeat)){
      header("Location: ../addnewuser.php?error=empty_password_or_username");
      exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../addnewuser.php?error=invalidusername");
      exit();
    }
    else if($password !== $passwordRepeat){
      header("Location: ../addnewuser.php?errors=passwordsincorrect");
      exit();
    }
    else {
      $sql = "SELECT username FROM users WHERE username = ?";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../addnewuser.php?errors=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt,"s",$username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if($resultCheck > 0 || $username == "admin") {
          header("Location: ../addnewuser.php?errors=useristaken");
          exit();
        }
        else {
          $sql = "INSERT INTO users (username,userpassword) VALUES (?, ?)";
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../addnewuser.php?error=sqlerror");
            exit();
          }
          else {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt,'ss',$username,$hashedPwd);
            mysqli_stmt_execute($stmt);
            header("Location: ../adminpanel.php?success");
            exit();
          }
        }
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
  else {
    header("Location: ../addnewuser.php");
    exit();
  }
 ?>
