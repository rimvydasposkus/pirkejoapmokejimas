<!DOCTYPE html>
<html>
<?php include('header.php');
require ('includes/showdata.inc.php');
if(isset($_SESSION['userName'])) {
}else{
  header("location: login.php");
  exit();
}
?>
<h2 align="center">Excel failo įkėlimas</h2>

    <div class="outer-container">
        <form action="adfiles.php" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data" align ="center">
            <div>
                <label>Pasrinkite Excel
                    File</label> <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import"
                    class="btn-submit">Importuoti</button>

            </div>

        </form>
        <?php
          $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          if(strpos($fullUrl, "formatfailedtoread") == true){
            echo "<p class = 'blogas'> Skolu lentelės duomenys neatitiko excelio failo duomenų tipui.</p>";
            include('footer.php');
            exit();
          }elseif(strpos($fullUrl, "formatfailedtoread1") == true){
            echo "<p class = 'blogas'> Avansų lentelės duomenys neatitiko excelio failo duomenų tipui</p>";
            include('footer.php');
            exit();
          }elseif(strpos($fullUrl, "filedoesntexic") == true){
            echo "<p class = 'blogas'> Duomenų failas nebuvo pasirinktas</p>";
            include('footer.php');
            exit();
          }
        ?>
    </div>



<?php include('footer.php'); ?>
</html>
