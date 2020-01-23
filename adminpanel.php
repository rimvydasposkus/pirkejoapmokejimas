<!DOCTYPE html>
<html>
<?php include('header.php');
if(isset($_SESSION['adminName'])) {
}else{
  header("location: login.php");
  exit();
}
require ('includes/showdata.inc.php');
?>
<form action="includes/adminpanel.inc.php" method="POST">
  <div class="container spaces">
    <div class = "row d-flex align-items-start">
      <div class="col"><button class="btn btn-secondary bd-white float-right" name='logout'>Atsijungti</button></div>
    </div>
      <div class = "row wrapper2">
  <table class="table table-bordered admintable">
      <thead>
        <tr>
          <th scope="col">Vartotojo ID</th>
          <th scope="col">Vartotojo vardas</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          while($row=mysqli_fetch_assoc($result)){

           ?>
          <td><?php print $row['ID']?></td>
          <td><?php print $row['username']?></td>
        </tr>
        <?php
      }
      ?>
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between">
    <button class="btn btn-secondary bd-white" name='change_psw'>Slaptaž. keit.</button>
    <button class="btn btn-secondary bd-white" name='add_user'>Pridėti vart.</button>
    <button class="btn btn-secondary bd-white" name='delete_user'>Ištrinti vart.</button>
  </div>
</div>
</form>
<?php include('footer.php'); ?>
</html>
