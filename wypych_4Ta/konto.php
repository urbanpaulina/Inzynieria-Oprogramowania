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
?>



<?php
		
		echo '<center><br>
		<div id="naglowek1"> 
		<a href="konto.php?str=1"> Moje dane  | </a>
		<a href="konto.php?str=2"> Moje albumy | </a>
		<a href="konto.php?str=3"> Moje zdjęcia </a>
		<br><br>
		</div>';
		
	if ($_GET['str'] == 1)
	
	{
		echo '
			
		<center>
		<div id="naglowek">
		Moje dane
		<br>
		</div>	
		<div id="formularz"> 
		<form action="konto.php" method="post">
		Nowe hasło: <input type="password" name="zhaslo" maxlength="20"><br><br>
		Potwierdź hasło: <input type="password" name="haslo2"  maxlength="20"><br><br>
		Stare hasło: <input type="password" name="hasloStare"  maxlength="20"><br><br>
		Email: <input type="text" name="zemail"><br><br>
		<input type="submit" name="Zarejestruj" value="Zmień dane" style="cursor:pointer;background: #CC0033; height: 40px; width: 120px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);">
		</div>
		</form>
		<br>
		<br>
		<center>
		</div>
		
		<div id="echo">';
		
	
	
	$emailz=$_POST['zemail'];
	$hasloz=$_POST['zhaslo'];
	
	
if (isset($_POST['zhaslo']))
	{
	
	if (strlen($_POST['zhaslo']) != 0) 
	{
		if ($_POST['hasloStare'] == $_SESSION['s1haslo'])
			{
				if ($_POST['zhaslo'] == $_POST['haslo2'])
					{
							if ( strlen($hasloz) >= 6)
							{
										if (preg_match('/[A-Z]/', $hasloz))
										{
											if (preg_match('/[0-9]/', $hasloz))
											{
												if (preg_match('/[a-z]/', $hasloz))
												{	
														session_start();
														$_SESSION['shaslo']=$hasloz;
		
														$zdhaslo = $_POST['zhaslo'];
														mysqli_query($conn, "UPDATE użytkownicy SET haslo='".md5($zdhaslo)."' WHERE id='".$_SESSION['Id']."';");
														
														header("Location: konto.php");
														echo "Poprawnie zmieniłeś swoje dane";
															}
													else echo "W haśle nie ma małych liter";
												}
											else echo "W haśle nie ma cyfr";
											}
										else echo "W haśle nie ma dużych liter";
										}
									else echo "Hasło jest za krótkie";	
					}
					else echo "Hasła są różne<br>";
			}
			else echo "Poprzednie hasło jest nieprawidłowe<br>";
	}
	else echo "Nie podałeś nowego hasła<br>";
	}
	
if (isset($_POST['zemail']))
	{	
		if (strlen($emailz) == 0)
			{
				echo "Email jest nieprawidłowy";
			}
				else
						{	
							$zdemail = $_POST['zemail'];
							mysqli_query($conn, "UPDATE użytkownicy SET email='".$zdemail."' WHERE id='".$_SESSION['Id']."';");
						}
	}
		
	}
	
	if ($_GET['str'] == 2)
	{
		echo '<div id="naglowek">
		Moje albumy
		<br>
		</div>';
	$dane = mysqli_query($conn, "SELECT albumy.id AS IdAlbum , tytul , albumy.data AS DataAlbumu ,
								min(zdjecia.id) AS IdZdjecia , login, użytkownicy.id AS IdWlasc 
								FROM albumy,`zdjecia`, użytkownicy WHERE id_albumu=albumy.id 
								AND albumy.id_uzytkownika=".$_SESSION['Id']." 
								group BY IdAlbum;");  	

		if (isset($_POST['usun']))
		{
					$usuwanieAlbumu=$_POST['idalbumu'];
					function removeDirectory($path) {
					$files = glob($path . '/*');
					foreach ($files as $file) {
						is_dir($file) ? removeDirectory($file) : unlink($file);
					}
					rmdir($path);
			return;
		}
			
			mysqli_query($conn, "DELETE albumy, zdjecia_komentarze, zdjecia_oceny, zdjecia
							FROM albumy 
							LEFT JOIN zdjecia
							ON zdjecia.id_albumu = albumy.id 
							LEFT JOIN zdjecia_komentarze
							ON zdjecia.id= zdjecia_komentarze.id_zdjecia
							LEFT JOIN zdjecia_oceny
							ON zdjecia.id = zdjecia_oceny.id_zdjecia 
							WHERE albumy.id =".$usuwanieAlbumu."");
							removeDirectory("IMG/".$usuwanieAlbumu."");
							header ("Location: konto.php?str=2");
							
		}
if (isset($_POST['zmien']))

{			
		$zmianaNazwy=$_POST['idalbumu'];
		mysqli_query($conn, "UPDATE `albumy` SET tytul='".$_POST['albumnazwa']."' WHERE albumy.id=".$zmianaNazwy."; ");
}
		
	while ($wynik = mysqli_fetch_assoc($dane)) 
		
		{  
			$tytulAlbumu=$wynik['tytul'];
			$nazwaWlascicel=$wynik['login'];
			$DataDodania=$wynik['DataAlbumu'];
		
			echo '<div class="albumyz"><a class="tooltipTextLink" href="album.php?album='.$wynik['IdAlbum'].'&wlasciciel='.$wynik['IdWlasc'] .'&stronagaleria='.$strona.'&sortowaniegaleria='.$s.'" >
			<img src="IMG/'.$wynik['IdAlbum'].'/'.$wynik['IdZdjecia'].'" width="180px"; height="180px"; text-align:center; />
			<span class="tooltipText">Tytuł albumu: '.$tytulAlbumu.'<br>Autor: '.$nazwaWlascicel.'<br>Data utworzenia:<br/>'.$DataDodania.'</span></a>';
			echo "&nbsp&nbsp&nbsp";
		
		
	
	
	echo '
			<form method="POST" onsubmit="return confirm(\'Czy na pewno?\')">
			<input type="submit" name="usun" style="cursor:pointer;background: #CC0033; height: 40px; width: 120px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
			 value="Usuń album" >
			 
			 <input type="submit" name="zmien" style="cursor:pointer;background: #CC0033; height: 40px; width: 130px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
			 value="Zmień nazwę albumu" >
			 <br>
			 <br>
			 <input type="text" name="albumnazwa">
			<input  id="idalbumu"  name="idalbumu" type="hidden" value="' . $wynik['IdAlbum'] . '">
			</form></div>';
		}
	}

	if ($_GET['str'] == 3)
	{
		echo '<div id="naglowek">
		Moje zdjęcia
		</div>';
		
			echo '
			<br>
			<div id="komunikat">
				Wybierz album
				</div>
				<br>';
				
			$a=mysqli_query($conn, "SELECT * FROM albumy WHERE id_uzytkownika=".$_SESSION['Id'].";");
			$danea=mysqli_fetch_assoc($a);
			
			while ($danea=mysqli_fetch_assoc($a))
			{
				echo  '<a href="konto.php?str=4&album='.$danea['id'].'">  '.$danea['tytul'].'  </a>';
			}
	}
	if ($_GET['str'] == 4)
	{
			echo '<div id="naglowek">
				Moje zdjęcia
				<br>
				</div>';
	
			
				if (isset($_POST['usunZdj']))
					{
						$usuwanieZDJ = $_POST['idzdjecia'];
						$usuwanieALB = $_POST['idalbumu'];
						
						unlink("IMG/".$usuwanieALB."/".$usuwanieZDJ."");
						mysqli_query($conn, "DELETE zdjecia, zdjecia_komentarze, zdjecia_oceny 
											FROM zdjecia 
											LEFT JOIN zdjecia_komentarze
											ON zdjecia.id=zdjecia_komentarze.id_zdjecia
											LEFT JOIN zdjecia_oceny
											ON zdjecia.id=zdjecia_oceny.id_zdjecia 
											WHERE zdjecia.id =".$usuwanieZDJ."");
						
											
							
					}
			
			if (isset($_POST['zmienopis']))

				{			
					$zmianaopis=$_POST['idzdjecia'];
					mysqli_query($conn, "UPDATE `zdjecia` SET opis='".$_POST['zdjecienazwa']."' WHERE zdjecia.id=".$zmianaopis."; ");
				}
				
			$zdjeciaa = mysqli_query($conn, "SELECT albumy.id AS IdAlbum, zdjecia.id AS zdjeciaID, tytul FROM albumy, zdjecia WHERE id_albumu=albumy.id AND zdjecia.id_albumu=albumy.id AND id_uzytkownika=".$_SESSION['Id']." AND zaakceptowane=1 AND albumy.id=".$_GET['album']."");
				
			echo '<br>';
			while ($zdjecialista = mysqli_fetch_assoc($zdjeciaa)) 
		{  		
			echo '<div class="albumyz"><img src="IMG/'.$zdjecialista['IdAlbum'].'/'.$zdjecialista['zdjeciaID'].'" width="180px"; height="180px"; text-align:center; />';
			echo "&nbsp&nbsp&nbsp";
		
			echo '<form method="POST" onsubmit="return confirm(\'Czy na pewno?\')">
				<input type="submit" name="usunZdj" style="cursor:pointer;background: #CC0033; height: 40px; width: 120px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
				value="Usuń zdjęcie" >
			 
				 <input type="submit" name="zmienopis" style="cursor:pointer;background: #CC0033; height: 40px; width: 180px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
				 value="Zmień opis zdjęcia" >
				 <br>
				 <br>
				 <input type="text" name="zdjecienazwa">
				 <input  id="idzdjecia"  name="idzdjecia" type="hidden" value="'.$zdjecialista['zdjeciaID']. '">
				  <input id="idalbumu" name="idalbumu" type="hidden" value="'.$zdjecialista['IdAlbum']. '">
				 </form></div>';
				 
				 
		}
	}
	
	?>



	
	
		<div id="stopka" >
		
	
			
		Autor: Mateusz Wypych kl. 4 Ta
		
		</div>

</body>
</html>