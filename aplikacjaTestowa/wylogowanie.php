<?php
include 'connect.php';
unset ($_SESSION['a']);
unset ($_SESSION['sllogin']);
unset ($_SESSION['s1haslo']);
unset ($_SESSION['uprawnienia']);
Session_Destroy();
header ('location:index.php');

?>
