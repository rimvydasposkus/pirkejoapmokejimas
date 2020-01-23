<?php
  require 'dbh.inc.php';

if(isset($_POST['Search'])) {
  $searchq = $_POST['search'];
  $free = '0000-00-00';
  $SQL = mysqli_query($conn,"UPDATE skolos SET apmdata = NULL WHERE apmdata='$free'");
  if(empty($searchq)){
    header("Location: index.php?error=empty");
    exit();
  }
  $stmt = $conn -> prepare("SELECT * FROM skolos WHERE pirkejas=?");
  $stmt->bind_param("s", $searchq);
  $stmt->execute();
  $result= $stmt -> get_result();
    if($result->num_rows === 0){
      header("Location: index.php?error=nouser");
      exit();
    };
  $stmt1 = $conn ->prepare("SELECT * FROM avansas WHERE pirkejas=?");
  $stmt1 ->bind_param("s", $searchq);
  $stmt1 -> execute();
  $result1= $stmt1 -> get_result();
}else{

}if(isset($_POST['quit'])){
  session_start();
  $sql = "SELECT pirkejas,data,terminas,saskaita,doknr,turinys,suma,apmoketa,apmdata,val FROM skolos";
   mysqli_set_charset('utf8', $sql);
$setRec = mysqli_query($conn, $sql);
$columnHeader = '';
$columnHeader = "pirkejas" . "\t" . "data" . "\t" . "terminas" . "\t" . "saskaita" . "\t" . "doknr" . "\t" . "turinys" . "\t" . "suma" . "\t" . "apmoketa" . "\t" . "apmokejimo data" . "\t" . "valiuta" . "\t";
$setData = '';
  while ($rec = mysqli_fetch_row($setRec)) {
    $rowData = '';
    foreach ($rec as $value) {
        $value = '"' . $value . '"' . "\t";
        $rowData .= $value;
    }
    $setData .= trim($rowData) . "\n";
    $row = mb_convert_encoding($setData, "UTF-8");
}

header("Content-type: application/octet-stream");
header('Content-Type: text/html; charset=utf-8');
header("Content-Disposition: attachment; filename=Pavyzdys.xls");
header("Pragma: no-cache");
header("Expires: 0");
  echo ucwords($columnHeader) . "\n" . $row . "\n";
mysqli_query($conn, "DELETE FROM avansas");
mysqli_query($conn, "DELETE FROM skolos");
  session_destroy();
  header("Location: login.php");

}
 ?>
