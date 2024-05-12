<?php
# memulakan fungsi SESSION
session_start();

#Memanggil fail header.php & fail connection.php 
include('header.php');
include('connection.php');
?>

<!-- Tajuk antaramuka-->
<h3> Pendaftaran Peserta Baharu </h3>

<!-- Borang Pendaftaran ahli Baru-->
<form action = 'signup-proses.php' method = 'POST'>

    Nama Peserta <input type ='text' name ='nama'    required> <br>
    Nokp Peserta <input type ='text' name ='Nokp'    required> <br>
    
    Nama Universiti
    <select name='kod_universiti' ><br> 
        <option selected disabled value>Sila Pilih Universiti</option>
        <?php
        # Proses memaparkan senarai kumpulan motosikal dalam bentuk drop down list 
        $arahan_sql_pilih = "select* from universiti";
        $laksana_arahan_pilih = mysqli_query($condb,$arahan_sql_pilih); 
        while($m=mysqli_fetch_array($laksana_arahan_pilih))
        {
            echo "<option value='".$m['kod_universiti']."'>
                ".$m['namauniversiti']."
                </option>";
        }

        ?>
    </select> <br> 
    Katalaluan      <input type ='password'  name ='katalaluan' required> <br>
    <input type ='submit'    value='Daftar'> 
</form>
<?php include ('footer.php');?>