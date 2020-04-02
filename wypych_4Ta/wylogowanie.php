<?php
include 'connect.php';
unset ($_SESSION['zalogowany']);
unset ($_SESSION['login']);
unset ($_SESSION['haslo']);
unset ($_SESSION['typ_konta']);
unset ($_SESSION['Imie']);
unset ($_SESSION['Nazwisko']);
unset ($_SESSION['email']);
Session_Destroy();
header ('location:index.php');
?>