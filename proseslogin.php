<?php
session_start();
require_once ('koneksi.php');
function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$user = antiinjection($_POST['username']);
$pass     = antiinjection(($_POST['password']));
$cekuser = mysql_query("SELECT * FROM pengguna WHERE username = '$user'");
$jumlah = mysql_num_rows($cekuser);
$hasil = mysql_fetch_array($cekuser);
if ( $jumlah == 0 ) {
header('location:login.php?userfail');
} else {
    if ( $pass <> $hasil['password'] ) {
header('location:login.php?passwordfail');
    } else {
        $_SESSION['username'] = $user;
        header('location:index.php');
    }
}
?>