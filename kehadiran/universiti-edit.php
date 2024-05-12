<?php
# Memulakan fungsi session
session_start();

# Memanggil fail header.php dan connection.php
include 'header.php';
include 'connection.php';
# Dapatkan URL
$kod_universiti = $_GET['id'];

#Sambung ke table universiti
$dataModel = mysqli_query($condb, "SELECT * FROM universiti
WHERE kod_universiti= '$kod_universiti'");
$qModel = mysqli_fetch_array($dataModel);
?>
<html>

<div class ="wrapper">
    <div class = "main-content">
<!-- PAPAR ISI --> 

        <div id = "isi">
            <head>
                <h2 style ="text-align:center"> EDIT UNIVERSITI</h2>
            </head>
            <body>
                <form method = "POST" action ="universiti-kemaskini-proses.php">
                    <p> UNIVERSITI<br>
                        <input type ="text" name="nama" value="<?php echo $qModel['namauniversiti'];?>"
                            size="50" required autofocus></p>
                        <input type ="text" name="id" value="<?php echo $qModel['kod_universiti'];?>" hidden><br>
                        <button name="submit" type="submit" class="warnabutton">SIMPAN</button><br>
                    <br><font color= 'red'> Pastikan Maklumat Anda Betul</font>
                </form>
            </body>
        </div>
    </div>
</div>

<!-- PAPAR FOOTER --> 
<?php include 'footer.php'?>
</html>