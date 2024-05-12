<?php 
# sambung ke database
include "connection.php";
include "header.php";

#DAPATKAN URL
$idDel = $_GET['id'];

# LAKSANAKAN SQL
mysqli_query($condb, "DELETE FROM universiti WHERE 
kod_universiti= '$idDEL'");

#PAPAR MESEJ
echo "<script>alert('UNIVERSITI BERJAYA DIHAPUSKAN!! ANDA BOLEH BERBUKA');
window.location='senarai-universiti.php'</script>";
?>