
<html>
<?php include('header.php'); ?>
<form action="includes/login.inc.php" method="POST">
    <table class = "table userstable" align = "center">
      <thead class="thead-dark">
        <tr>
          <td class="text-center"> Prisijungimas </td>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>Vardas<br><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Slaptažodis<br><input type="password" name="password"></td>
        </tr>
        <tr>
            <td><button type="submit" class="btn btn-outline-dark" name = "login">Prisijungti</button></td>
      </tbody>
    </table>
</form>
<?php
  $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if(strpos($fullUrl, "error=empty_password_or_username") == true){
    echo "<p class = 'blogas'> Vartotojo vardo ar slaptažodžio laukelis negali būti tuščias</p>";
    include('footer.php');
    exit();
  }elseif(strpos($fullUrl, "error=sqlerror") == true){
    echo "<p class = 'blogas'> Klaida! Duomenų bazė nepasiekiama.</p>";
    include('footer.php');
    exit();
  }elseif(strpos($fullUrl, "error=wrong_userdont") == true){
    echo "<p class = 'blogas'> Toks vartotojas neegzistuoja arba neteisingas vartotojo slaptažodis</p>";
    include('footer.php');
    exit();
  }
?>
</html>
