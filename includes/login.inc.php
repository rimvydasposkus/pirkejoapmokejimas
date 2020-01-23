<?php
if (isset($_POST['login'])){

    require 'dbh.inc.php' ;

    $username = $_POST['username'];
    $password = $_POST['password'];
    $nameErr = $emailErr = $genderErr = $websiteErr = "";

    if(empty($username) || empty ($password)) {
        header("location: ../login.php?error=empty_password_or_username");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE username= ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../login.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['userpassword']);
                if($pwdCheck == false) {
                    header("Location: ../login.php?error=wrong_userdont");
                    exit();
                }
                else if($pwdCheck == true) {
                  session_start();
                  $_SESSION['userName'] = $row['username'];
                  header("Location: ../addfile.php");
                }
                else {
                  header("Location: ../login.php?error=wrong_userdont");
                  exit();
                }

            }
            else {
                $sql = "SELECT * FROM admins WHERE adminname= ?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location: ../login.php?error=sqlerror");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $username);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if($row = mysqli_fetch_assoc($result)) {
                        $pwdCheck = password_verify($password, $row['adminpassword']);
                        if($pwdCheck == false) {
                            header("Location: ../login.php?error=wrong_userdont");
                            exit();
                        }
                        else if($pwdCheck == true) {
                          session_start();
                          $_SESSION['adminName'] = $row['adminname'];
                          header("Location: ../adminpanel.php?Success");
                        }
                        else {
                          header("Location: ../error=wrong_userdont");
                          exit();
                        }

                    }
                  else{
                header("Location: ../login.php?error=wrong_userdont");
                exit();
              }
            }
          }
        }
    }
}

else {
    header("Location: ../login.php?erorr=wtf");
    exit();
}
