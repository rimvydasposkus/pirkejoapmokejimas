<!DOCTYPE html>
<html>
<?php include('header.php');
if(isset($_SESSION['adminName'])) {
}else{
  header("location: login.php");
  exit();
} ?>
<form action="includes/newuser.inc.php" method="POST">
    <table class = "table userstable" align = "center">
      <thead class="thead-dark">
        <tr>
          <td class="text-center"> Sukurti nauja vartotoja </td>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>Username<input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password<input type="password" name="password"></td>
        </tr>
            <td>Repeat password<input type ="password" name = "repeatpsw"></td>
        <tr>
            <td><button type="submit" class="btn btn-outline-dark" name = "add_user">Sukurti</button></td>
        </tbody>
    </table>

</form>
<?php
  $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if(strpos($fullUrl, "error=empty_password_or_username") == true){
    echo "<p class = 'blogas'> Vartotojo Vardo ar slaptažodžio laukeliai negali būti tušti</p>";
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
  }elseif(strpos($fullUrl, "errors=useristaken") == true){
    echo "<p class = 'blogas'> Vartotojas su tokiu vardu jau yra užregistruotas duomenų bazėje</p>";
    include('footer.php');
    exit();
  }elseif(strpos($fullUrl, "error=invalidusername") == true){
    echo "<p class = 'blogas'> Vartotojo varde, negalima naudoti tokių simbolių</p>";
    include('footer.php');
    exit();
  }
  include('footer.php');
?>
</html>
