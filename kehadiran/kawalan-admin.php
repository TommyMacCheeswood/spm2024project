<?php
#menyemak nilai pembolehubah session['tahap']
if(!empty($_SESSION['tahap'])){
       if($_SESSION['tahap'] != "ADMIN")

       { #jika nilainya tidak sama dengan ADMIN aturcara akan dihentikan 
        die("<script>alert('sila login');
        window.location.href='logout.php';</script>");
       }
    }
    ?>

        
       