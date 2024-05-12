<?php
session_start();

// Memanggil fail header.php dan fail connection.php
include 'header.php';
?>
<html>
<div class="wrapper">
    <div class="main-content">
        <div id="menu">
            <!-- PANGGIL ISI -->
            <div id="isi">

            <head>
                <h2 style ="text-align: centre"> TAMBAH UNIVERSITI</h2>
            </head>

            <body>
            <!-- BORANG -->
            <form method ="POST" action="universiti-simpan.php">
                <p>NAMA UNIVERSITI<br>
                    <INPUT TYPE="text" name="namauniversiti" placeholder="TAIP DI SINI" size ="50"
                    required autofocus>
                </p><br>
                <div>
                    <button name ="submit" type="submit" class="warnabutton">SIMPAN</button>
                    <button type="reset" class="warnamerah">RESET</button>
                </div>
                <br>
                <font color ="red"> PASTIKAN ANDA MELETAKKAN MAKLUMAT DENGAN BETUL</font>
            </form>
            </body>
            </div>
        </div>
    </div>
</div>
<div style='margin-bottom: 500px;'></div>
<?php include 'footer.php' ?>
</html>