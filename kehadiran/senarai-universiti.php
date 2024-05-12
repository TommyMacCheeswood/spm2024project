<?php
// Memulakan fungsi session
session_start();

// Memanggil fail header.php dan fail connection.php
include('header.php');
include('connection.php');
?>
<html>
<body>
    <div class="wrapper">
        <div class = "main-content">
            <div id="isi">
                <center>
                    <h2><U>Senarai Universiti</U></h2>
                </center>
                <table align ="center" border=1 cellspacing="0">
                    <!-- PAPAR JENAMA --> 
                    <tr>
                        <td width = "30%" align= "center"> KOD UNIVERSITI</td>
                        <td width = "50%" align="center"> NAMA UNIVERSITI</td>
                        <td width = "70%" align="center"> TINDAKAN</td>
                    </tr>
                    <?php
                    #PANGGIL REKOD
                    $no = 1;
                    $data1 = mysqli_query($condb, "SELECT * FROM universiti ORDER BY namauniversiti ASC");
                    while ($info1 = mysqli_fetch_array($data1)) {
                    ?>
                        <tr>
                            <td align="center"><?php echo $no; ?></td>
                            <td height="60px" align-"center"><?php echo $info1['namauniversiti']; ?> </td>
                            <td>
                            <!-- PAPAR PAUTAN --> 
                            <a href="universiti-edit.php?id=<?php echo $info1['kod_universiti']; ?>" class="edit-button" >EDIT</a>  |
                            <a href="universiti-hapus.php?id=<?php echo $info1['kod_universiti']; ?>"
                               onclick="return confirm('ANDA PASTI?')" class="delete-button">HAPUS</a>
                    </tr>
                    <?php $no++;
                    } ?>
                </table>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
 </body>
 </html>