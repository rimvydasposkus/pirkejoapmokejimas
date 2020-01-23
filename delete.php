<!DOCTYPE html>
<html>
<?php include('header.php');
if(isset($_SESSION['adminName'])) {
}else{
  header("location: login.php");
  exit();
} ?>
<form action="includes/delete.inc.php" method="POST">
    <table class = "table userstable" align = "center">
      <thead class="thead-dark">
        <tr>
          <td class="text-center"> Ištrinti vartotoja </td>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>Vartotojo ID<input type="text" name="userId"></td>
        </tr>
        <tr>
            <td><button type="submit" class="btn btn-outline-dark" name = "delete_user" onclick="return confirm('Ar tikrai norite ištrinti šį vartotoja?')">atnaujinti</button></td>
        </tbody>
    </table>

</form>
<?php
  $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if(strpos($fullUrl, "error=emptyfields") == true){
    echo "<p class = 'blogas'> Tuščias ID laukelis</p>";
    include('footer.php');
    exit();
  }elseif(strpos($fullUrl, "error=sqlerror") == true){
    echo "<p class = 'blogas'> Klaida! Duomenų bazė nepasiekiama.</p>";
    include('footer.php');
    exit();
  }elseif(strpos($fullUrl, "errors=nousers") == true){
    echo "<p class = 'blogas'> Vartotojas su tokiu vardu jau yra užregistruotas duomenų bazėje</p>";
    include('footer.php');
    exit();
  }
?>
<?php include('footer.php'); ?>
</html>
