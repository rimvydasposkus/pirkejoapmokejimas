<head>
  <meta charset="UTF-8">
</head>
<?php
require_once('includes/dbh.inc.php');
require_once('Vendor/php-excel-reader/excel_reader2.php');
require_once('Vendor/SpreadsheetReader.php');

if (isset($_POST["import"]))
{

  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'Vendor/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        try
        {
        $Reader = new SpreadsheetReader($targetPath);
      }
      catch (Exception $e)
      {
        echo $e -> getMessage();
      }

        $sheetCount = count($Reader->sheets());

        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);

            foreach ($Reader as $Row)
            {

                $pirkejas = "";
                if(isset($Row[0])) {
                    $pirkejas = mysqli_real_escape_string($conn,$Row[0]);
                }

                $data = "";
                if(isset($Row[1])) {
                    $data = mysqli_real_escape_string($conn,$Row[1]);
                }
                $terminas = "";
                if(isset($Row[2])) {
                    $terminas = mysqli_real_escape_string($conn,$Row[2]);
                }
                $saskaita = "";
                if(isset($Row[3])) {
                    $saskaita = mysqli_real_escape_string($conn,$Row[3]);
                }
                $doknr = "";
                if(isset($Row[4])) {
                    $doknr = mysqli_real_escape_string($conn,$Row[4]);
                }
                $turinys = "";
                if(isset($Row[5])) {
                    $turinys = mysqli_real_escape_string($conn,$Row[5]);
                }
                $suma = "";
                if(isset($Row[6])) {
                    $suma = mysqli_real_escape_string($conn,$Row[6]);
                }
                $apmoketa = "";
                if(isset($Row[7])) {
                    $apmoketa = mysqli_real_escape_string($conn,$Row[7]);
                }
                $apmdata = "";
                if(isset($Row[8])) {
                    $apmdata = mysqli_real_escape_string($conn,$Row[8]);
                }
                $valiuta = "";
                if(isset($Row[9])) {
                    $valiuta = mysqli_real_escape_string($conn,$Row[9]);
                }
              if(!empty($pirkejas) || !empty($data) ||  !empty($saskaita) || !empty($suma) || !empty($valiuta)){
                    if($saskaita==2711){
                      if(!empty($doknr) || !empty($skola)){
                        $skola = $suma-$apmoketa;
                    $query = "insert into skolos(pirkejas,data,terminas,saskaita,doknr,turinys,suma,apmoketa,apmdata,skola,val) values('".$pirkejas."','".$data."','".$terminas."','".$saskaita."','".$doknr."','".$turinys."','".$suma."','".$apmoketa."','".$apmdata."','".$skola."','".$valiuta."')";
                    $result = mysqli_query($conn, $query);
                    if (! empty($result)) {
                    header("Location: index.php?success");
                    } else {
                        header("Location: addfile.php?formatfailedtoread");
                    }
                }
                }elseif($saskaita==4441){
                    $query = "insert into avansas(pirkejas,data,saskaita,turinys,suma,val) values('".$pirkejas."','".$data."','".$saskaita."','".$turinys."','".$suma."','".$valiuta."')";
                    $result = mysqli_query($conn, $query);
                    if (! empty($result)) {
                    header("Location: index.php?success");
                    } else {
                        header("Location: addfile.php?formatfailedtoread1");
                    }


                  }
             }
           }
         }
  }
  else
  {
  header("Location: addfile.php?filedoesntexic");
  }
}
?>
