<?php

/*if(isset($_GET['del_id'])){

  if(isset($_SESSION['admin']) && ($_SESSION['admin']==1)){
      mysqli_query($conx,"UPDATE produktuak SET descripzioa = '' WHERE ID LIKE ".$_GET['del_id']);
    header("Location: ".$_SERVER['PHP_SELF']);
  }else{
    header("Location: ".$_SERVER['PHP_SELF']);
  }

}*/

if(isset($_GET['postdescription'])){
    $crntquery = mysqli_query($conx,"SELECT deskripzioa, salneurria FROM produktuak WHERE ID LIKE ".$_GET['pic_id']);
    $crntcomm = mysqli_fetch_array($crntquery);
    $error = false;

    if($_POST['deskripzioa'] != ''){
        $deskripzioa = trim($_POST['deskripzioa']);
    }else{
        $error = true;
        echo "Deskribapena derrigorrezkoa da";
    }

    if ($_POST['salneurria'] != '' && is_numeric($_POST['salneurria'])) {
        $salneurria = trim($_POST['salneurria']);
    }else{
        $salneurria = $crntcomm['salneurria'];
    }

    if($error == false){
        mysqli_query($conx,"UPDATE produktuak SET deskripzioa = '".$deskripzioa."', salneurria = ".$salneurria." WHERE ID LIKE ".$_GET['pic_id']);
        header("Location: ".$_SERVER['PHP_SELF']);
    }  
}else{

?>

<div align=center>
    <fieldset style=width:300;>
    <legend><b>Descripción</b></legend>
    <br>
    <?php
        $picquery = mysqli_query($conx,"SELECT * FROM produktuak WHERE ID = ".$_GET['pic_id']);
        $data = mysqli_fetch_array($picquery);

        echo "<h4>".$data['izena']." - ".$data['salneurria']."€</h4>";
        echo "<img src=images/".$data['pic']." border=1><br>";
    ?>
    <br>
    <form action="<?php echo $_SERVER['PHP_SELF']."?action=description&pic_id=".$_GET['pic_id']."&postdescription=1";?>" method=POST>
        <h5>Deskripzioa:</h5>
        <textarea name=deskripzioa cols=50 rows=10>
            <?php
            echo $data['deskripzioa'];
            ?>
        </textarea><br>
        <br>
        Salneurri berria: <input type="number" name="salneurria">
        <br>
        <br>
        <input type=submit value="Aldatu">
    </form>
    </fieldset>
</div>

<?php

}

?>