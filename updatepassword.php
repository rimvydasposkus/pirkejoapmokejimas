<!DOCTYPE html>
<html>
<?php include('header.php');
if(isset($_SESSION['adminName'])) {
}else{
  header("location: login.php");
  exit();
} ?>
<form action="includes/updatepassword.inc.php" method="POST">
    <table class = "table userstable" align = "center">
      <thead class="thead-dark">
        <tr>
          <td class="text-center"> Pakeisti vartotojo slaptažodį </td>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>Vartotojo ID<input type="text" name="userId"></td>
        </tr>
        <tr>
            <td>Slaptažodis<input type="password" name="password"></td>
        </tr>
            <td>Pakartoti slaptažodi<input type ="password" name = "repeatpsw"></td>
        <tr>
            <td><button type="submit" class="btn btn-outline-dark" name = "change_user">atnaujinti</button></td>
        </tbody>
    </table>

</form>
<?php
  $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if(strpos($fullUrl, "error=empty_password_or_username") == true){
    echo "<p class = 'blogas'> Vartotojo ID ar slaptažodžio laukeliai negali būti tušti</p>";
    include('footer.php');
    exit();
  }elseif(strpos($fullUrl, "error=sqlerror") == true){
    echo "<p class = 'blogas'> Klaida! Duomenų bazė nepasiekiama.</p>";
    include('footer.php');
    exit();
  }elseif(strpos($fullUrl, "errors=passwordsincorrect") == true){
    echo "<p class = 'blogas'> Parašyti slaptažodžiai nesutampa</p>";
    include('footer.php');
    exit();
  }elseif(strpos($fullUrl, "errors=nouser") == true){
    echo "<p class = 'blogas'> Vartotojas su tokiu ID, neegzisuotja</p>";
    include('footer.php');
    exit();
  }include('footer.php');
?>

</html>
