<?php
require 'dbh.inc.php' ;
  if(isset($_POST['change_user'])) {

    $userId = $_POST['userId'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['repeatpsw'];

    if(empty($userId) || empty($password) || empty($passwordRepeat)){
      header("Location: ../updatepassword.php?error=empty_password_or_username");
      exit();
    }
    else if($password !== $passwordRepeat){
      header("Location: ../updatepassword.php?errors=passwordsincorrect");
      exit();
    }else {
      $sql = "SELECT ID FROM users WHERE ID = ?";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../updatepassword.php?errors=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt,"i",$userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if($resultCheck == 0) {
          header("Location: ../updatepassword.php?errors=nouser");
          exit();
        }
    else {
      $sql = "UPDATE users SET userpassword=? WHERE  ID=?";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../updatepassword.php?errors=sqlerror");
        exit();
      }
      else{
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,'si',$hashedPwd,$userId);
        mysqli_stmt_execute($stmt);
        header("Location: ../adminpanel.php?success");
        exit();
    }
  }
  }
  }
}
else {
  header("Location: ../updatepassword.php");
  exit();
}
  ?>
