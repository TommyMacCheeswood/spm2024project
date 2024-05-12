<?php
#memulakan fungsi SESSION
session_start();

#menyemak kewujudan data post
if(!empty($_POST))
{
    #Memanggil fail connection.php
    include('connection.php');

    #Mengambil data yang dihantar dari fail signup-borang.php
    $nama           =  $_POST['nama'];
    $Nokp           =  $_POST['Nokp'];
    $kod_universiti =  $_POST['kod_universiti'];
    $katalaluan     =  $_POST['katalaluan'];

    # data validation : had atas had bawah
    # nokp yang dimasukkan hendaklah 12 digit dan tidak mempunyai huruf atau simbol
    if(strlen($Nokp)  != 12 or !is_numeric($Nokp))
    {
        die ("<script>alert ('Ralat Pada No Kad Pengenalan'); 
        window.location.href='signup-borang.php'; </script>");
    }

# Menyemak adakah nokp yang dimasukkan telah wujud dalam pangkalan data
$arahan_sql_semak       =  "select* from peserta where Nokp='$Nokp' limit 1";
$laksana_arahan_semak   =  mysqli_query($condb,$arahan_sql_semak);
if(mysqli_num_rows($laksana_arahan_semak)==1)
{
    #jika nokp yang dimasukkan telah wujud. aturcara akan dihentikan.
    die("<script>alert('RALAT NOKP. Nokp yang dimasukkan telah digunakan');
    window.location.href='signup-borang.php';</script>");
}

# arahan SQL (query) untuk menyimpan data ahli baharu
$arahan_sql_simpan = "insert into peserta (Nokp, nama, kod_universiti, katalaluan, tahap) values ('$Nokp', '$nama', '$kod_universiti', '$katalaluan', 'AHLI BIASA')";

#melaksanakan arahan SQL menyimpan data ahli baru.
$laksana_arahan_simpan = mysqli_query($condb, $arahan_sql_simpan);

#menguji jika proses menyimpan data berjaya atau tidak
if($laksana_arahan_simpan)
{
    #jika data berjaya disimpan, papar popup dan buka fail login-borang
    echo"<script>alert('Pendaftaran Berjaya. Sila Log Masuk');
    window.location.href='index.php'; </script>";
}
else
    {
        #jika data tidak berjaya disimpan. papar popup dan buka fail signup-borang
        echo"<script>alert('Pendaftaran Gagal');
        window.location.href='signup-borang.php'; </script>";
    }

}
else
{
    #jika pengguna buka fail ini tanpa mengisi data.
    #papar popup dan buka fail <signup-borang.php
    echo"<script>alert('Sila lengkapkan maklumat');
    window.location.href='signup-borang.php'; </script>";
}
?>
