<?php
#memulakan fungsi session
session_start();

#menyemak kewujudan data post yang dihantar dari login-borang.php
if(!empty($_POST['Nokp']) and !empty($_POST['katalaluan']))
{
    #memanggil fail connection.php
    include ('connection.php');

    #Mengambil data yang di POST dari fail Borang
    $Nokp       =  $_POST['Nokp'];
    $katalaluan =  $_POST['katalaluan'];

    #Arahan SQL (query) untuk membandingkan data yang dimasukkan wujud di pangkalan data atau tidak
    $query_login = "select * from peserta
    where
            Nokp        =  '$Nokp'
    and     katalaluan  =  '$katalaluan' LIMIT 1";

    #melaksanakan arahan membandingkan data
    $laksana_query = mysqli_query($condb, $query_login);

    #jika terdapat 1 data yang sepadan, login berjaya
    if(mysqli_num_rows($laksana_query)==1)
    {
        #mengambil data yang ditemui
        $m  =  mysqli_fetch_array($laksana_query);

        #mengumpukkan kepada pemboleh ubah session
        $_SESSION['Nokp']   =   $m['Nokp'];
        $_SESSION['tahap']  =   $m['tahap'];

        #membuka laman index.php
        echo"<script>window.location.href='index.php';</script>";

    }
    else
    {
        #login gagal. kembali ke laman login-borang.php
        die("<script>alert('Login Fail. Bro Does not listen to Yeat');
        window.location.href='login-borang.php';</script>");
    }
}
    else
    {#data yang dihantar dari laman login-borang.php kosong
    die("<script>alert('sila masukkan Nokp dan katalaluan');
    window.location.href='login-borang.php';</script>");
    }
    ?>