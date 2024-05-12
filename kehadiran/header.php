<html>
    <head>
        <link rel = "stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, inital-scale=1">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <div class="header">
        <br><h1>PERTANDINGAN GOLF ANTARABANGSA 2024</h1>
        <h2>Annual Collegiate Golf Competition in Malaysia</h2>
    </div>
<body>

<?php
if(!empty($_SESSION['tahap']) and $_SESSION['tahap']=="ADMIN"){ ?>
    <div class ="topnav" id="myTopnav">
        <a class ="active" href="index.php"             >Laman Utama</a>
        <a href="profil.php"                            >Profil</a>
        <a href="kehadiran-rekod.php"                   >Kehadiran</a>
        <a href="senarai-peserta.php"                   >Senarai Peserta</a>
        <a href="kehadiran-laporan.php"                 >Laporan Kehadiran</a>
    <div class ="dropdown">
        <button class="dropbtn"                         > Universiti
            <i class=" fa fa-caret-down"></i>
        </button>
        <div class ="dropdown-content">
        <a href="senarai-universiti.php"                > Senarai Universiti</a>
        <a href="universiti-tambah.php"                 > Tambah Universiti</a>
        </div>
    </div>
    <a href ="logout.php"                               > Logout</a>
    </div>

<?php }
 else if(!empty($_SESSION['tahap']) and $_SESSION['tahap']=="AHLI BIASA")
 { ?>
    <!--Menu ahli: dipaparkan sekiranya ahli biasa telah login -->
    <div class="topnav" id="myTopnav">
        <a class="active" href="index.php"              >Laman Utama</a>
        <a href="profil.php"                            >Profil</a>
        <a href="logout.php"                            >Logout</a>
    </div>
<?php }
else
{?>
    <!--menu Laman Utama : dipaparkan sekiranya admin atau ahli biasa tidak login -->
    <div class="topnav" id="myTopnav">
        <a class="active" href="index.php"              >Laman Utama</a>
        <a href="login-borang.php"                      >Daftar Masuk</a>
    </div>
<?php } ?>
<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += "responsive";
    } else {
        x.className ="topnav";
    }
}
</script>
</body>
</html>


