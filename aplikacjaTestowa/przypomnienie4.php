<?php

$haslo1=$_POST['haslo1ID'];
$haslo2=$_POST['haslo2ID'];
include "connect.php";
$login2=$_SESSION["login2"];
$email2=$_SESSION["email2"];


if($haslo1==$haslo2) {
	mysqli_query($conn,"UPDATE uzytkownicy SET haslo = '$haslo1' WHERE login ='$login2' and email='$email2'");
	require "przypomnienie3.php";
	echo "Haslo zostalo zmienione!";
}
else {
	require "przypomnienie3.php";
echo "Hasla sa niezgodne!";
}


?>