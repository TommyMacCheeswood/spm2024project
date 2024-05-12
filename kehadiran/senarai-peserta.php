<?php
# memulakan fungsi session
session_start();

# memanggil fail header.php, connection.php dan kawalan-admin.php
include ('header.php');
include ('connection.php');
include ('kawalan-admin.php');
?>

<!-- Header bagi jadual untuk memaparkan senarai ahli -->
<h3> Laporan Kehadiran Ke Pertandingan Golf Antarabangsa 2024</h3>
<h3>Kelab Golf Salty Springs</h3>

<table align = 'center' width = '100%' border='1' id='saiz'>
<tr bgcolor= 'cyan'
    <td colspan = '4'>
        <form action='' method='POST' style="margin:0; padding:0;" >
            <input type='text'  name='nama' placeholder='Carian Nama Peserta' >
            <input type='submit' value='cari' >
        </form>  
</td>
<td colspan = '3' align= 'right' >
   | <a href = 'upload.php' >Muat Naik Peserta</a>|
    <?php include('butang-saiz.php'); ?>
</td>
</tr>
    <tr>
        <td>Bil</td>
        <td>Nama</td>
        <td>Nokp</td>
        <td>Nama Universiti</td>
        <td>Katalaluan</td>
        <td>Tahap</td>
        <td>Tindakan</td>
</tr>
<?php
#syarat tambahan yang akan dimasukkan dalam arahan(query) senarai peserta
$tambahan="";
if(!empty($_POST['nama']))
{
    $tambahan = "and peserta.nama like '%".$_POST['nama']."%'";

}
# arahan query untuk mencari senarai nama peserta
$arahan_papar="select* from peserta, universiti
where peserta.kod_universiti = universiti.kod_universiti $tambahan";

# laksankan arahan mencari data peserta
$laksana = mysqli_query($condb, $arahan_papar);
$bil = 0;

# Mengambil data yang ditemui
    while($m = mysqli_fetch_array($laksana))
    {
        # umpukkan data kepada tatasusunan bagi tujuan kemaskini peserta
        $data_get=array(
            'nama'           =>      $m['nama'],
            'Nokp'           =>      $m['Nokp'],
            'katalaluan'     =>      $m['katalaluan'],
            'tahap'          =>      $m['tahap'],
            'kod_universiti' =>      $m['kod_universiti'],
            'namauniversiti' =>      $m['namauniversiti']

        );
        # memaparkan senarai nama dalam jadual pada antaramuka
        echo"<tr>
        <td>".++$bil."</td>
        <td>".$m['nama']."</td>
        <td>".$m['Nokp']."</td>
        <td>".$m['namauniversiti']."</td>
        <td>".$m['katalaluan']."</td>
        <td>".$m['tahap']."</td>
        ";

        #memaparkan navigasi untuk kemaskini dan hapus data peserta
        echo"<td>
        |<a href='kemaskini-borang.php?".http_build_query($data_get)."'>
        Kemaskini</a>

        |<a href='padam-proses.php?Nokp=".$m['Nokp']."'
        onClick = \"return confirm('Anda Pasti Anda Ingin Memadam data ini.')\">
        Hapus</a>|

        </td>
        </tr>";

    }
?>
</table>
<?php include('footer.php'); ?>