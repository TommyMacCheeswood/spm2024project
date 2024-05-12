<?php
# memulakan fungsi session
session_start();

#memanggil fail kawalan-admin.php 
include('kawalan-admin.php');

# menyemak kewujudan data POST
if(!empty($_POST))
{
    # memanggil fail connection.php
    include('connection.php');

    # pengesahan data (validation) Nokp peserta
    if(strlen($_POST['Nokp']) != 12 or !is_numeric($_POST['Nokp']))
    {
        die("<script>alert('Ralat Nokp');
        window.history.back();</script>");
    }
# arahan SQL (query) untuk kemaskini maklumat peserta
$arahan             =     "update peserta set
nama                =     '".$_POST['nama']."',
Nokp                =     '".$_POST['Nokp']."',
katalaluan          =     '".$_POST['katalaluan']."',
kod_universiti      =     '".$_POST['kod_universiti']."',
tahap               =     '".$_POST['tahap']."'
where      
Nokp                =     '".$_GET['nokp_lama']."' ";

# melaksana dan menyemak proses kemaskini
if(mysqli_query($condb,$arahan))
{
    # kemaskini berjaya
    echo"<script>alert('Kemaskini Berjaya');
    window.location.href='senarai-peserta.php';</script>";
}
else
{
    # kemaskini gagal
    echo "<script>alert('Kemaskini Gagal');
    window.history.back();</script>";
}
}
else
{
    #Jika data GET tidak wujud, kembali ke fail senarai-peserta.php 
    die("<script>alert('Sila lengkapkan data');
    window.location.href='senarai-peserta.php';</script>");
}
?>