<?php
require ('includes/search.inc.php');
require ('includes/editables.inc.php');
session_start();
if(isset($_SESSION['userName'])) {
}else{
  mysqli_query($conn, "DELETE FROM avansas");
  mysqli_query($conn, "DELETE FROM skolos");
  header("location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bakalauras</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<?php include_once "includes/design.inc.php"; ?>
</head>

<body>
    <div class="container-fluid 0px" id="selectorOne">
    <div class="row">
        <div class="col-xl-4">
            <form action = "index.php" method="post">
            Tiekėjas <input type="text" id="tiekejas" class="ziurim" name="search" onkeydown = "if (event.keyCode == 13)
                        document.getElementById('btnSearch').click()">
                        <button type="submit" class="btn btn-outline-dark" id = "btnSearch" name = "Search" style="display: none;"></button>
        </div>
        <div class="col-xl-4">
          <?php
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if(strpos($fullUrl, "error=empty") == true){
              echo "<p class = 'blogas1'> Tuščias tiekėjo laukelis</p>";
            }elseif(strpos($fullUrl, "error=nouser") == true){
              echo "<p class = 'blogas1'> Informacijos apie įrašyta tiekėja, nėra.</p>";

            }

           ?>
        </div>
        <div class="col-xl-2">
            Data <input type="text" class="inputw" id="data" value="2018.01.01">
        </div>
        <div class="col-xl-2">
            Sąsk. <input type="text" class="inputw" id="saskaita" value="271">
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2 pr-0">
    Suma<input type="text" id="suma" name = "suma" onkeypress= "return isNumberKey(event)">
        <input type="text" id="valiuta"  name="val" value = "EUR">
      </div>
    <div class="col-xl-4 p-0 corrector">
    Dok. Nr. <input type="text" class="inputw" id="dokNr">
    </div>
    <div class="col-xl-2">
    Tabelio Nr. <input type="text" class="inputw" id="tabelioNr">
  </div>
  <div class="col-xl-2">
  Ord Nr. <input type="text" id="orderioNr">
  </div>
  <div class="col-xl-2">
  Dt. <input type="text" id="dt">
  </div>
  </div>
  <div class="row">
      <div class="col-xl-4 corrector1">
        <button class="btn btn-secondary bd-white float-right " onclick="paskirstyti()" name="skirstyti" type="button">Paskirstyti</button>
      </div>
      <div class="col-xl-6">
            <div class="float-right"><input type="checkbox" class="form-check-input"> Formuoti finansines operacijas</div>
      </div>
      <div class="col"><button class="btn btn-secondary bd-white float-right" name="issaugoti" formaction = "index.php">įrašyti</button></div>
    </div>
</div>
<div class="container-fluid wrapper">
<table class="table table-bordered" id="skolos">
    <thead>
      <tr>
        <th scope="col-xl-2">Pirkėjas</th>
        <th scope="col">Data</th>
        <th scope="col">Terminas</th>
        <th scope="col">Sąskaita</th>
        <th scope="col">Doknr.</th>
        <th scope="col">Suma</th>
        <th scope="col">Apmokėta</th>
        <th scope="col">Apm.data</th>
        <th scope="col">Skola</th>
        <th scope="col">Val</th>
        <th scope="col">Įrašoma</th>
      </tr>
    </thead>
    <tbody>
      <tr>

        <?php
        $sum = '';
        while($row = mysqli_fetch_assoc($result)){
          if($row['suma'] == $row['apmoketa']){}
            else { ?>
        <th scope="row"><?php print $row['pirkejas']?></th>
        <td><input name="sdata[]" type="hidden" value="<?php print $row['data']?>"><?php print $row['data']?></td>
        <td><?php print $row['terminas']?></td>
        <td><?php print $row['saskaita']?></td>
        <td><?php print $row['doknr']?></td>
        <td><?php print $row['suma']?></td>
        <td><?php print $row['apmoketa']?></td>
        <td><?php print $row['apmdata']?></td>
        <td><?php print $row['skola']?></td>
        <td><?php print $row['val']?></td>
        <td id="rowIrasyti"><input type="text" id="irasyti" name="irasoma[]" onkeypress= "return isNumberKey(event)"></td>

      </tr>

    <?php $sum = $sum+$row['skola'];}
  }
    ?>
    </tbody>
</table>
</div>
  <div class="container-fluid" id="selectorTwo">
    <div class="row justify-items-start">
      <div class="col-xl-3">
        <div>
        Sandėliai <input type="text" id="sandel">
        </div>
        <div>
        Data iki <input type="text" id="dataiki">
        </div>
        <div>
        Terminas iki <input type="text" id="terminasiki">
        </div>
        <div>
        <input type="checkbox"> Grąžinimai
        <input type="checkbox" class="ml-5"> Pirkimai
        </div>
      </div>
      <div class="col-xl-5">
        <div>
        <input type="checkbox" class="form-check-input"> Avansas
        </div>
      <div class="wrapper1">
      <table class="table table-bordered " id = "avansai">
          <thead>
            <tr>
              <th scope="col">Data</th>
              <th scope="col">Turinys</th>
              <th scope="col">Suma</th>
              <th scope="col">Valiuta</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sums = '';
            while($row1 = mysqli_fetch_assoc($result1)){ ?>
            <tr>
              <td><?php print $row1['data']?></td>
              <td><?php print $row1['turinys']?></td>
              <td><?php print $row1['suma']?></td>
              <td><?php print $row1['val']?></td>
            </tr>
          <?php $sums=$sums+$row1['suma']; }
          function avansasSum() {
            global $sums;
            if($sums == 0){
              echo "0";
            }
            echo $sums;
          }
          ?>
          </tbody>
        </table>
        </div>
        <p class="avansassum" id="avansasSum"><?php avansasSum(); ?></p>
        </div>
        <div class="col-xl-3 sumaa" id="maxSum">
          <?php print $sum?>
        </div>
        <div class="col-xl-1 d-flex align-items-end">
            <button class="btn btn-secondary bd-white float right" name="quit">Išeiti</button>
        </div>
  </div>
</form>
  </div>
</body>
</html>
<script>
  function paskirstyti() {

    var avansas = parseFloat(document.getElementById('avansasSum').innerHTML)
    var maxSum = parseFloat(document.getElementById('maxSum').innerHTML)
    var sumaValue = parseFloat(document.getElementById('suma').value)
    var rowas = document.getElementById('skolos').rows
    var rowas1 = document.getElementById('avansai').rows
    if (sumaValue > avansas){
        alert("Įvesta suma: " + sumaValue + " yra per didelė, kadangi tiekėjo avanso iš viso yra: " + avansas )
        return
    }else {
    for(var y = 1; y<rowas1.length; y++){
      var avansai = document.getElementById('avansai').rows[y].cells[1].innerHTML
      for (var i = 1; i < rowas.length; i++) {
        var skola = parseFloat(document.getElementById('skolos').rows[i].cells[8].innerHTML)
      var doknr = document.getElementById('skolos').rows[i].cells[4].innerHTML
      if(avansai == doknr){
        if (sumaValue >= skola) {
          document.getElementById('skolos').rows[i].cells[10].getElementsByTagName('input')[0].value = skola.toFixed(2)
          var doknr = document.getElementById('skolos').rows[i].cells[4].innerHTML
          sumaValue = sumaValue - skola
        } else if (sumaValue < skola && sumaValue > 0) {
          document.getElementById('skolos').rows[i].cells[10].getElementsByTagName('input')[0].value = sumaValue.toFixed(2)
          var doknr = document.getElementById('skolos').rows[i].cells[4].innerHTML
          sumaValue = sumaValue - skola
        }
      }else {
        }
      }
    }
  }
    for (var i = 1; i < rowas.length; i++) {
      var skola = parseFloat(document.getElementById('skolos').rows[i].cells[8].innerHTML)
      if (sumaValue >= skola) {
        document.getElementById('skolos').rows[i].cells[10].getElementsByTagName('input')[0].value = skola.toFixed(2)
        sumaValue = sumaValue - skola
      } else if (sumaValue < skola && sumaValue > 0) {
        document.getElementById('skolos').rows[i].cells[10].getElementsByTagName('input')[0].value = sumaValue.toFixed(2)
        sumaValue = sumaValue - skola
      }
    }
  }


  function isNumberKey(evt){
      var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57))){
  return false;
}else {
      return true;
    }
  }
</script>
