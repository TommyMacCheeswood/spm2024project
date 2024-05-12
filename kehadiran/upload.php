<?php
#memulakan fungsi session
session_start();

# memanggil fail header, kawalan-admin
include('header.php');
include('kawalan-admin.php');
?>

<!-- Tajuk laman --> 
<h3>Muat Naik Data Peserta (*.txt)</h3>

<!-- Borang untuk muat naik fail --> 
<form action='' method='POST' enctype='multipart/form-data'>
    <h3><b> Sila Pilih Fail txt yang ingin diupload</b></h3>
    <input  type='file'     name='data_peserta'>
    <button type='submit'   name='btn-upload'>Muat Naik</button>

</form>
<?php include('footer.php'); ?>

<!-- Bahagian Memproses data yang dimuat naik --> 
<?php
# data validation : menyemak kewujudan data dari borang
if(isset($_POST['btn-upload']))
{
    # memanggil fail connection
    include ('connection.php');

    #mengambil nama sementara fail
    $namafailsementara=$_FILES["data_peserta"]["tmp_name"];

    # mengambil nama fail
    $namafail=$_FILES["data_peserta"]['name'];

    #mengambil jenis fail
    $jenisfail = pathinfo($namafail,PATHINFO_EXTENSION);

    #menguji jenis fail dan saiz fail
        if($_FILES["data_peserta"]["size"]>0 AND $jenisfail=="txt")
        {
            # membuka fail yang diambil
            $fail_data_peserta = fopen($namafailsementara,"r");

            # mendapatkan data dari fail baris demi baris 
            while(!feof($fail_data_peserta))
            {
                # mengambil data sebaris sahaja bagi setiap pusingan
                $ambilbarisdata = fgets($fail_data_peserta);

                #memecahkan baris data mengikut tanda pipe
                $pecahkanbaris = explode("|",$ambilbarisdata);

                #selepas pecahan tadi akan diumpukan kepada 5
                list($Nokp,$nama,$kod_universiti,$katalaluan,$tahap) = $pecahkanbaris;

                # arahan SQL untuk menyimpan data
                $arahan_sql_simpan="insert into peserta(Nokp, nama, kod_universiti, katalaluan, tahap) values('$Nokp', '$nama','$kod_universiti', '$katalaluan', '$tahap')";

                # memasukkan data ke dalam jadual peserta
                $laksana_arahan_simpan = mysqli_query($condb, $arahan_sql_simpan);
                echo"<script>alert('Import Fail Data Selesai');
                window.location.href = 'senarai-peserta.php';
                </script>";
            }
        # menutup fail txt yang dibuka
        fclose($fail_data_peserta);
        }
        else
        {
            # jika fail yang dimuat naik kosong atau tersalah format.
            echo"<script>alert('hanya fail berformat txt sahaja dibenarkan'); </script>";
        }
}
?>