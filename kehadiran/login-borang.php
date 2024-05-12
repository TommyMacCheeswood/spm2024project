<?php
#memulakan fungsi session
session_Start();

#memanggil fail header.php
include('header.php');
?>

<!-- Tajuk antarmuka log masuk -->
<h3>Login Peserta</h3>

<!-- borang daftar masuk (log in/sign in) -->
<form action='login-proses.php' method='POST'>
    Nokp        <input type='text'      name='Nokp' ><br>
    Katalaluan  <input type='password'  name='katalaluan' ><br>
                <input type='submit'    value='Login'>
</form>
<?php include ('footer.php'); ?>
