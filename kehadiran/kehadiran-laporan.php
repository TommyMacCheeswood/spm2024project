<?php
#memulakan fungsi session
session_start();

# memanggil fail header.php, connection.php, dan kawalan-admin.php
include('header.php');
include('connection.php');
include('kawalan-admin.php');

# Mendapatkan Analisis Kehadiran (bil hadir dan bil peserta)
$arahanSQL=" SELECT
        ( SELECT COUNT(*) FROM kehadiran ) AS bil_hadir,
        ( SELECT COUNT(*) FROM peserta ) AS bil_peserta";
$laksanaSQL     =       mysqli_query($condb, $arahanSQL);
$ma             =       mysqli_fetch_array($laksanaSQL);
?>

<!-- Header bagi jadual untuk memaparkan senarai --> 
<h3 align = 'center'>
    Laporan Kehadiran Ke Pertandingan Golf Antarabangsa 2024 <br> Kelab Golf Salty Springs
    <br>Kehadiran : <?= $ma['bil_hadir']." / ".$ma['bil_peserta'] ?>
</h3>
<?php 
# Syarat tambahan yang akan dimasukkan dalam arahan(query) senarai peserta
$tambahan="";
if(!empty($_POST['nama']))
{
    $tambahan = " where peserta.nama like '%".$_POST['nama']."%'";

}
?>

<!-- Memanggil fail butang-saiz bagi membolehkan pengguna mengubah saiz tulisan --> 
<table align ='center' width ='100%' border='1' id='saiz' >
    <tr bgcolor = 'cyan'>
        <td colspan = '2'>
            <form action='' method='POST' style"margin:0; padding:0;">
                <input type ='text' name='nama' placeholder='Carian Nama Peserta'>
                <input type='submit' value='Cari'>
            </form>
        </td>
   <td colspan='2'
    align= 'right'>
<?php include('butang-saiz.php');
    ?>
    </td>
</tr>
<tr>
    <td width ='5%'>Bil</td>
    <td>Nama</td>
    <td>Nokp</td>
    <td width = '5%' > Kehadiran</td>
</tr>
<?PHP
# arahan query untuk mencari senarai
$arahan_papar=" SELECT *, peserta.Nokp FROM peserta
LEFT JOIN kehadiran ON peserta.Nokp = kehadiran.Nokp
$tambahan ORDER BY peserta.nama";

# laksanakan arahan mencari data
$laksana = mysqli_query($condb, $arahan_papar);
$hadir=$takhadir=$bil=0;

# Mengambil data yang ditemui
while($m = mysqli_fetch_array($laksana))
{
    # memaparkan senarai nama dalam jadual
    echo"<tr>
    <td>".++$bil."</td>
    <td>".$m['nama']."</td>
    <td>".$m['Nokp']."</td>
    <td align='center'>";

    if(strlen($m['masa_hadir'])>=1) {
        echo "&#9989;";
    } else {
        echo "&#10060;";
    }
    echo"</td></tr>";
}
echo"</table>";
# Adding a spacer before including the footer
echo "<div style='margin-bottom: 100px;'></div>";
include('footer.php'); ?>