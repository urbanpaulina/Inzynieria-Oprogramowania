 <!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="CSS/style.css" type="text/css">
<title>
</title>
</head>
<body>
<br>
<?php
include 'menu.php';
$wybraneZdjecieID = $_GET['zdjecie'];
$wybranyAlbumID = $_GET['album'];

echo '<br>';

echo "<div id='formularz1'>";


echo '<a href="album.php?album='.$_GET['album'].'&strona=1"><button style="cursor:pointer;background: #CC0033; height:30px; width:180px;font-size:15px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59);
																background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);
																	background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);
																		background: linear-gradient(top, #CC0033, #FF3366);"> Powrót do albumu </button></a>';


$zdjecieDane = mysqli_query($conn, "SELECT zdjecia.id AS zdjeciaID, tytul, zdjecia.data AS dataZdjecia, użytkownicy.login AS autor, opis
									FROM `albumy`,`zdjecia`, `użytkownicy` WHERE zdjecia.id_albumu=albumy.id 
									AND albumy.id_uzytkownika=użytkownicy.id AND zdjecia.id='".$wybraneZdjecieID."'");

									$zdjecieDaneWynik = mysqli_fetch_assoc($zdjecieDane);
									
		if ($zdjecieDaneWynik['opis']!="")
			{
				echo "<div>Album: ".$zdjecieDaneWynik['tytul']." <br>Data dodania: ".$zdjecieDaneWynik['dataZdjecia']."<br> Twórca: ".$zdjecieDaneWynik['autor']." <br> Opis: ".$zdjecieDaneWynik['opis']."</div>";
			} 

		else 
			{
				echo "<div>Album: ".$zdjecieDaneWynik['tytul']." <br>Data dodania: ".$zdjecieDaneWynik['dataZdjecia']."<br> Twórca: ".$zdjecieDaneWynik['autor']."<br> </div>";
			}

			do
			{  
				echo '<br><img src="img/'.$wybranyAlbumID.'/'.$wybraneZdjecieID.'"/></a>';
	
			}
			while ($zdjecieDaneWynik = mysqli_fetch_assoc($zdjecieDane));

echo "</div>";

	echo "<div>";
		$ocenyDane = mysqli_query($conn, "SELECT id_zdjecia, ocena, id_uzytkownika FROM zdjecia_oceny WHERE id_zdjecia =$wybraneZdjecieID ");
		$ocenyDaneWynik = mysqli_fetch_assoc($ocenyDane); 
		$ocenyIlosc= mysqli_num_rows($ocenyDane); 

		echo "<div id='formularz1'>";
		
if ($ocenyIlosc == 0)
	{
	echo "Nie ma jeszcze ocen";
	}
else 
	{
		$ocenySuma=0;
do 
{
	$ocenySuma+=$ocenyDaneWynik['ocena'];
}	 
while ($ocenyDaneWynik = mysqli_fetch_assoc($ocenyDane));

$ocenySrednia=$ocenySuma/$ocenyIlosc;

if ($ocenyIlosc==0)
	{echo "Zdjęcie nie ma jeszcze ocen";}
  else {
	echo "Średnia ocena zdjęcia: ".$ocenySrednia." Zdjęcie oceniło: ".$ocenyIlosc." użytkowników"; 
}

}
echo "</div>";


?>

			<?php
			echo "<div id='formularz1'>";
			$liczenie = mysqli_query($conn, "SELECT COUNT(*) FROM zdjecia_oceny WHERE id_zdjecia='".$_GET['zdjecie']."' AND id_uzytkownika='".$_SESSION['Id']."';");
			$liczenieDane = mysqli_fetch_assoc($liczenie);
			
			if ($liczenieDane['COUNT(*)'] == 0 && $_SESSION['a'] == 1 )
			{
				echo '<form method="POST" >
				<br>
				Dodaj ocenę:
				<br>
				<input type = "number" min="1" max="10" name="ocenaZdj"/>
				<br>
				<br>
				<input type = "submit" name="ocenaZdjecie"  value="Wyślij" style="cursor:pointer;background: #CC0033; height: 40px; width: 80px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59);
																background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);
																	background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);
																		background: linear-gradient(top, #CC0033, #FF3366);"></div>
			

</form>';
echo "<div id='pasek'>" ;
			echo "</div>";
echo "</div>";
				if(isset($_POST['ocenaZdjecie']))
					{
						
						$ocenaZ = $_POST['ocenaZdj'];
						mysqli_query($conn, "INSERT INTO `zdjecia_oceny` (`id_zdjecia`, `id_uzytkownika`, `ocena`) VALUES ('".$wybraneZdjecieID."', '".$_SESSION['Id']."', '".$ocenaZ."');");
						header('location:foto.php?album=' . $_GET['album'] . '&wlasciciel='.$_GET['wlasciciel']. '&zdjecie='.$_GET['zdjecie']."");
					}
			}
			elseif($liczenieDane['COUNT(*)'] !== 0 && $_SESSION['a'] == 1 )
			{
				echo "Oceniłeś już to zdjęcie.";
			}
			else 
			{
				echo "Nie jesteś zalogowany. Zaloguj się.";
			}
			
			
			?>
			
			
			<?php
		
			if(isset($_POST['SendingComent']))
					{
						$komentarzZ = trim($_POST['komentarzO']);
						mysqli_query($conn, "INSERT INTO `zdjecia_komentarze` (`id_zdjecia`, `id_uzytkownika`, `data` , `komentarz` , `zaakceptowany`) VALUES ('".$wybraneZdjecieID."', '".$_SESSION['Id']."', '".date('Y-m-d H:i:s')."', 
						'".$komentarzZ."', '0' );");
						header('location:foto.php?album=' . $_GET['album'] . '&wlasciciel='.$_GET['wlasciciel']. '&zdjecie='.$_GET['zdjecie']."");
					}
			
			echo "<div id='formularz1'>";
	
		if ($_SESSION['a']==1)
			
			{

				echo	'<form method="POST" >
						<br>
						Dodaj Komentarz:
						<br>
						<textarea cols="40" rows="4" name="komentarzO" ></textarea>
						<br>
						<br>
						<input type = "submit" name="SendingComent"  value="Wyślij" style="cursor:pointer;background: #CC0033; height: 40px; width: 80px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59);
																background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);
																	background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);
																		background: linear-gradient(top, #CC0033, #FF3366);"></div><br><br>';
																	
																		
		echo "</div>";
		
			}
		
		echo "<br><div id='naglowek3'>Komentarze";
		echo "</div>";
		
		
			$liczenieKomentarze = mysqli_query($conn, "SELECT COUNT(*) FROM zdjecia_komentarze WHERE id_zdjecia='".$_GET['zdjecie']."' AND zaakceptowany='1';");
			$liczenieKomentyDane = mysqli_fetch_assoc($liczenieKomentarze);
			
			
		
		if ($liczenieKomentyDane['COUNT(*)'] > 0)
		{
			$wyszukiwanie = mysqli_query($conn, "SELECT data, komentarz, id_uzytkownika FROM zdjecia_komentarze WHERE id_zdjecia='".$_GET['zdjecie']."' AND zaakceptowany='1'  ORDER BY
												zdjecia_komentarze.data DESC;");
			
		
		while ($wyswietlanieKom = mysqli_fetch_assoc($wyszukiwanie))
		{		
			$loginUz = mysqli_query($conn,  "SELECT login FROM użytkownicy WHERE id='" .$wyswietlanieKom['id_uzytkownika']. "';");
			$loginUZdane = mysqli_fetch_assoc($loginUz);
			
		
			echo "<div id='formularz1'>";
				echo "<br>Autor: ".$loginUZdane['login']."<br>" ;
				echo "<br>Data dodania: ".$wyswietlanieKom['data']."<br> ";
				echo "<br> ".$wyswietlanieKom['komentarz']." ";
					echo "<div id='pasek'>" ;
					echo "</div>";
			echo "</div>";
		}
			
		}
		else 
			{
				echo  " <div id='formularz1'> Brak komentarzy </div>";
			}
			
			echo '<div id="formularz">';
			
			echo '<a href="album.php?album='.$_GET['album'].'&strona=1"><button style="cursor:pointer;background: #CC0033; height:30px; width:180px;font-size:15px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59);
																background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);
																	background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);
																		background: linear-gradient(top, #CC0033, #FF3366);"> Powrót do albumu </button></a>';
			echo '</div>';
		
		?>
		
		
		
		
</form>
			
<br><br><br>
</body>
</html>
