<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="CSS/style.css" type="text/css">
<title>
</title>
</head>
<body>
<?php
include 'menu.php';

	echo "
	<div id='naglowek'>
	Najlepiej oceniane zdjęcia
	</div>
	<br>
	<br>
<div id='formularz1'>";
	$dane = mysqli_query($conn, "SELECT zdjecia.id AS zdjeciaID , tytul, albumy.id AS AlbumyId, AVG(ocena) as Srednia, login, użytkownicy.id AS IdWlasc, zdjecia.data AS DataZdjecia FROM `albumy` ,`zdjecia`, `zdjecia_oceny` , `użytkownicy`
									WHERE zdjecia.id_albumu=albumy.id AND zdjecia.id=zdjecia_oceny.id_zdjecia AND albumy.id_uzytkownika=użytkownicy.id AND zaakceptowane=1
									group by zdjeciaID order by Srednia DESC LIMIT 20");  	


	while ($wynik = mysqli_fetch_assoc($dane)) 
		{  
			$tytulAlbumu=$wynik['tytul'];
			$nazwaWlascicel=$wynik['login'];
			$DataDodania=$wynik['DataAlbumu'];
			$DataZDJ=$wynik['DataZdjecia'];
			$srocena=$wynik['Srednia'];
			
		
	echo '<a class="tooltipTextLink" href="foto.php?album='.$wynik['AlbumyId'].'&wlasciciel='.$_GET['wlasciciel'].'&zdjecie='.$wynik['zdjeciaID'].'&stronagaleria=1&sortowaniegaleria=tytul&strona=1">
	<img src="IMG/'.$wynik['AlbumyId'].'/'.$wynik['zdjeciaID'].'" width="180px"; height="180px"; text-align:center; />
	<span class="tooltipText">Tytuł albumu: '.$tytulAlbumu.'<br>Autor: '.$nazwaWlascicel.'<br>Data utworzenia:<br/>'.$DataZDJ.'<br>Średnia ocena:<br/>'.$srocena.'</span></a>';
	echo "&nbsp&nbsp&nbsp";
	
	
	
	};


 
?>

		
		<div id="stopka">
			
		Autor: Mateusz Wypych kl. 4 Ta
		
		</div>

</body>
</html>