<?php
# memulakan fungsi session
session_start();

#memanggil fail luaran dan istihar pemboleh ubah.
include('header.php');
include('kawalan-admin.php');
include('connection.php');
$masa = date("H:I:S");
$status=""; #Digunakan untuk memaparkan status kehadiran
$warna=""; #Digunakan untuk warna latar belakang status
$bil=0;

# menyemak kewujudan data POST
if(!empty($_POST['Nokp'])){
    # Proses menyemak adakah Nokp yang dimasukkan telah wujud dalam pangkalan data
    $arahan_sql_semak  =  "select* from peserta where Nokp='".$_POST['Nokp']."'";
    $laksana_arahan_semak = mysqli_query($condb, $arahan_sql_semak);
    if(mysqli_num_rows($laksana_arahan_semak)!=1)
    {
        #Jika Nokp yang dimasukkan telah wujud.
        $status="Nokp yang dimasukkan / diimbas tiada dalam sistem";
        $warna="red";

    }
    else {
        #Proses menyemak Nokp yang dimasukkan telah merekodkan kehadiran atau tidak
        $arahan_semak   =   "select* from kehadiran where Nokp='".$_POST['Nokp']."'";
        $laksana_arahan =   mysqli_query($condb,$arahan_semak);
        if(mysqli_num_rows($laksana_arahan)==1)
        {
            $status="Anda telah mengesahkan kehadiran sebelum ini.";
            $warna="red";
        }
    else{
        # Proses menyimpan data kehadiran
        $simpandata=mysqli_query($condb,"insert into kehadiran (Nokp, masa_hadir) values ('".$_POST['Nokp']."','$masa') ");

        #menyemak adakah proses menyimpan data berjaya
        if($simpandata)
        {
            $status ="Kehadiran Telah Disahkan";
            $warna ="green";
        }
    else{
            $status ="Kehadiran Gagal direkodkan";
            $warna ="red";
        }
      }
    }
}

#Mendapatkan Analisis Kehadiran (bil hadir & bil peserta)
$arahanSQL=" SELECT
( SELECT COUNT(*) FROM kehadiran ) AS bil_hadir,
( SELECT COUNT(*) FROM peserta ) AS bil_peserta";
$laksanaSQL     =   mysqli_query($condb, $arahanSQL);
$ma             =   mysqli_fetch_array($laksanaSQL);
?>

<!-- Header bagi jadual untuk memaparkan senarai -->
<h1 align= 'center' > Laman Rekod Kehadiran Kaunter Urusetia</h1>
<h3 align='center'>
    Kehadiran Ke Pertandingan Golf Antarabangsa 2024
    <br> Kelab Golf Salty Springs
    <br>Analisis Kehadiran : <?= $ma['bil_hadir']." / ".$ma['bil_peserta'] ?>
</h3>

<form align = 'center' action = '' method='POST'>
<label>Masukkan / Imbas Nokp / KOD anda di sini</label><br>
    <input type='text' name='Nokp' autofocus autocomplete="off" required
    onblur="this.focus()" ><br>
    <input type='submit' value='Rekod Kehadiran' >
</form>

<table width='50%' border='1' align ='center' >
    <caption style = "background-color :<?= $warna ?>"><h3><? = $status; ?></h3></caption>
    <tr>
        <td>#</td>
        <td>Nokp</td>
        <td>Nama</td>
        <td>Nama Universiti</td>
        <td>Masa Hadir</td>
    </tr>

<?php
    # Arahan untuk memaparkan rekod kehadiran
    $arahan_sql_kehadiran = "select * from peserta, kehadiran, universiti where
        peserta.Nokp                  =   kehadiran.Nokp
    and peserta.kod_universiti        = universiti.kod_universiti
    order by kehadiran.masa_hadir DESC";

    # Melaksanakan arahan memaparkan rekod kehadiran
    $laksana_kehadiran = mysqli_query($condb, $arahan_sql_kehadiran);
    while($m    =   mysqli_fetch_array($laksana_kehadiran)){
        # memaparkan rekod kehadiran
        echo " <tr>
                    <td>".++$bil."</td>
                    <td>".$m['Nokp']."</td>
                    <td>".$m['nama']."</td>
                    <td>".$m['namauniversiti']."</td>
                    <td>".$m['masa_hadir']."</td>
               </tr>";

    }
?>
</table>
<?PHP include ('footer.php'); ?>