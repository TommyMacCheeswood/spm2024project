<?php
session_start();
# memanggil fail connection dan kawalan-biasa
include('connection.php');


$masa=date("H:I:S");

#menyemak kewujudan data session nokp
if(!empty($_SESSION['Nokp']))
{
    # Arahan simpan data kehadiran
    $sql = "insert into kehadiran (Nokp, masa_hadir)
    values ('".$_SESSION['Nokp']."','$masa') ";

    # Laksana arahan simpan
    $simpandata=mysqli_query($condb,$sql);

    # Menguji proses simpan
    if($simpandata){
        echo"<script>
        alert('Kehadiran Telah Disahkan');
        window.location.href='profil.php';
        </script>";
    }
    else {
        echo "<script>
        alert('Kehadiran GAGAL Disahkan. Sila Ke Meja Urusetia');
        window.location.href='profil.php';
        </script>";
    }
}
else{
    echo"<script>
    alert('Akses secara terus');
    window.location.href='logout.php';
    </script>";
}
?>