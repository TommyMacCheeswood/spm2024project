<?php
# memulakan fungsi session
session_start();

# memanggil fail kawalan-admin.php 
include('kawalan-admin.php');

#menyemak kewujudan data GET Nokp
if(!empty($_GET))
{
    # memanggil fail connection
    include('connection.php');

    # memanggil data GET
    $nokp   =   $_GET['Nokp'];

    # Arahan SQL untuk memadam data peserta berdasarkan Nokp peserta yand dihantar
    $arahan =   "delete from peserta where Nokp='$nokp'";

    # melaksanakan arahan SQL padam data dan menguji proses padam data
    if(mysqli_query($condb,$arahan))
    {
        # Jika data berjaya dipadam
        echo"<script>alert('Padam Data Berjaya');
        window.location.href='senarai-peserta.php';</script>";
    }
}
else
{
    # Jika data GET tidak wujud (empty)
    die("<script>alert('Ralat! akses secara terus');
    window.location.href = 'senarai-peserta.php';</script>");
}
?>