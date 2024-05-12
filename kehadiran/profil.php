<?php
#memulakan fungsi session
session_start();

# Memanggil fail header.php dan fail connection.php
include('header.php');
include('connection.php');

#Menyemak kewujudan nilai pembolehubah session['Nokp']
if(empty($_SESSION['Nokp'])){
    #Jika nilai session nokp tidak wujud/kosong. aturcara akan dihentikan
    die("<script>alert('sila login');
    window.location.href='logout.php';</script>");
}

# mendapatkan data pengguna yang sedang login
$sql = "SELECT
peserta.Nokp, peserta.nama, peserta.tahap,
universiti.namauniversiti,
kehadiran.masa_hadir
FROM peserta
LEFT JOIN universiti
ON universiti.kod_universiti = peserta.kod_universiti
LEFT JOIN kehadiran
ON peserta.Nokp = kehadiran.Nokp
where peserta.Nokp = '".$_SESSION['Nokp']."' ";

# Melaksanakan arahan mendapatkan data pengguna yang sedang login
$laksana_pilih = mysqli_query($condb,$sql);

# Data yang ditemui diumpukkan kepada pemboleh ubah $m
$m = mysqli_fetch_array($laksana_pilih);
?>

<table width = '100%' >
    <tr>
        <td width = '70%'   align='center'>
            <?php if(strlen($m['masa_hadir'])>0){
                echo "<h1 style=\"color:green;\" >
                Anda Telah Mengesahkan Kehadiran</h1>";
            
            } else {
                echo"<h1 style=\"color:red;\">Anda Belum Mengesahkan Kehadiran<br>
                Sila Ke Meja Urusetia Untuk Membuat Pengesahan</h1><br>
                <a href='profil-sahkendiri.php'
                onClick=\"return confirm('Anda Pasti?')\">
                Klik Sini Untuk Sahkan Kehadiran</a>";
            }
            ?>
        </td>
<td align = 'center' bgcolor='#afeeee'>
            <h3>IMBAS CODE UNTUK SAH KEHADIRAN</h3>
            <p>
                Nama : <?= $m['nama'] ?><br>
                Nokp : <?= $m['Nokp'] ?><br>
                Tahap: <?= $m['tahap'] ?><br>
                Universiti: <?= $m['namauniversiti'] ?>
            </p>
            <?PHP

            # Mengumpuk data untuk dijadikan QR code
            $data = $_SESSION['Nokp'];
            $saiz = "200x200";

            # set umpukkan data API untuk memaparkan QR code
            $qr_api = "https://api.qrserver.com/v1/create-qr-code/?size=$saiz&data=$data";

            #memaparkan QR code
            echo "<div align = 'center'><img width='50%' src='".$qr_api."'></div>";
            ?>
            <br>
        </td>
        </tr>
        </table>
        <?php include ('footer.php');?>