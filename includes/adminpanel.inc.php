<?php


  if(isset($_POST['logout'])){
    session_start();
    session_unset($_SESSION['adminName']);
    session_destroy();
    header("Location: ../login.php");
    exit();
  }else if(isset($_POST['change_psw'])){
    header("Location: ../updatepassword.php");
    exit();
  }else if(isset($_POST['add_user'])){
    header("Location: ../addnewuser.php");
    exit();
  }else if(isset($_POST['delete_user'])){
    header("Location: ../delete.php");
    exit();
  }else {
    header("Location: ../adminpanel.php");
    exit();
 }

 ?>
