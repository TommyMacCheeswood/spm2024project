<?php
# memulakan fungsi session
session_start();

# Memanggil fail header, connection dan kawalan-admin.php.
include('header.php');
include('kawalan-admin.php');
include('connection.php');

#Menyemak kewujudan data GET. Jika data GET empty, buka fail senarai-peserta
if(empty($_GET)){
    die("<script>window.location.href='senarai-peserta.php';</script>");

}
?>

<h3>Kemaskini Peserta Baharu</h3>

<form action='kemaskini-proses.php?Nokp_lama=<?= $_GET['Nokp'] ?>' method='POST'>

nama       <input type='text' name='nama'       value =' <?= $_GET['nama'] ?>'required><br>
Nokp       <input type='text' name='Nokp'       value =' <?= $_GET['Nokp'] ?>' required><br>
katalaluan <input type='text' name='katalaluan' value='<?= $_GET['katalaluan'] ?>'required><br>

tahap
<select name ='tahap'><br>
<option value ='<?= $_GET['tahap'] ?>'> <?= $_GET['tahap'] ?> </option>
<?php 
    # Proses memaparkan senarai tahap dalam bentuk drop down list
    $arahan_sql_tahap       =   "select tahap from peserta group by tahap order by tahap";
    $laksana_arahan_tahap   =   mysqli_query($condb, $arahan_sql_tahap);
    while($n=mysqli_fetch_array($laksana_arahan_tahap))
    {
        if($n['tahap'] != $_GET['tahap']){
            echo"<option value='".$n['tahap']."'>
            ".$n['tahap']."
            </option>";
        }
    }
?>
</select> <br>

Universiti
<select name ='kod_universiti'><br>
<option value ='<?= $_GET['kod_universiti'] ?>'>
<?= $_GET['namauniversiti'] ?>
</option>
<?php
    # Proses memaparkan senarai universiti dalam bentuk drop down list
    $arahan_sql_pilih   =   "select* from universiti";
    $laksana_arahan_pilih = mysqli_query($condb, $arahan_sql_pilih);
    while($m=mysqli_fetch_array($laksana_arahan_pilih))
    {
        if($m['kod_universiti'] != $_GET['kod_universiti']){
            echo"<option value='".$m['kod_universiti']."'>
            ".$m['namauniversiti']."
            </option>";
        }
    }
?>
</select> <br>

<input type='submit' value='Kemaskini'>

</form>
<?php include ('footer.php'); ?>