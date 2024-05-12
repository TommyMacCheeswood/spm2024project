<?php
require 'connection.php';
#TERIMA NILAI YG DI POST

if(isset($_POST['submit'])){

    $id= $_POST['id'];
    $nama=$_POST['nama'];
    $result2=mysqli_query($condb, "UPDATE universiti SET namauniversiti='$nama' WHERE kod_universiti='$id'");
    echo"<script>alert('Kemaskini jenama berjaya');
    window.location='senarai-universiti.php'</script>";
}
?>