<?php
require 'dbh.inc.php' ;
if (isset($_POST['issaugoti'])) {
$pirk = $_POST['spirk'];
$dat = $_POST['sterm'];
$das = $_POST['sdata'];
$vas = $_POST['sdoknr'];
$iras = $_POST['irasoma'];
$aar = array();
$sql = "SELECT doknr FROM skolos WHERE doknr = ?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../updatepassword.php?errors=sqlerror");
  exit();
}
foreach($alot as $a){
mysqli_stmt_bind_param($stmt,"s",$va);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$resultCheck = mysqli_stmt_num_rows($stmt);
var_dump($va);
if($resultCheck == 0) {
  header("Location: ../updatepassword.php?errors=nouser");
  exit();
}
else {
$sql = "UPDATE skolos SET apmoketa=? WHERE  doknr=?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
header("Location: ../updatepassword.php?errors=sqlerror");
exit();
}
else{
mysqli_stmt_bind_param($stmt,'si',$va,$iras);
mysqli_stmt_execute($stmt);
header("Location: ../adminpanel.php?success");
exit();
}
}
}
}
?>
