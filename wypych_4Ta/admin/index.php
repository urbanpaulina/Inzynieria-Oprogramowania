<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="../CSS/style.css" type="text/css">
<title>
</title>
</head>
<body>
<?php
include 'menu2.php';



	echo '<br>
		<div id="naglowek4">'; 
		if ($_SESSION['upr'] == "administrator") 	
			{	
	  echo '<a href="index.php?str=1"><div class="lista"> Albumy</div></a>
			<a href="index.php?str=2"><div class="lista"> Zdjecia</div></a>
			<a href="index.php?str=3"><div class="lista"> Komentarze </div></a>
			<a href="index.php?str=4"><div class="lista"> Użytkownicy</div></a>';
			}
	else 
		{
			echo '<a href="index.php?str=2"><div class="lista"> Zdjecia</div></a>
				  <a href="index.php?str=3"><div class="lista"> Komentarze</div></a>';
		}
			
	
		if ($_GET['str'] !=0 )
			{
				echo '<a href="javascript:history.back();"><div class="lista">Powrót do poprzedniej strony</div></a>';
			}
			
		
		echo '<div class="Witaj"><br><br> Witaj w panelu admina!<br>
		<img src="Admin.png" style="height="80px; width=80px;"></div>
		           </div>
		';
		
		if ($_GET['str'] == 1)
		
		{
			echo '<center><div id="naglowek6">
					Albumy
					<br>
					</div>';
					echo '<br>';
					
				

			$dane = mysqli_query($conn, "SELECT albumy.id AS IdAlbum , tytul , albumy.data AS DataAlbumu ,
								min(zdjecia.id) AS IdZdjecia , login, użytkownicy.id AS IdWlasc 
								FROM albumy,`zdjecia`, użytkownicy WHERE id_albumu=albumy.id  
								group BY IdAlbum;"); 
								
			$ilosc = mysqli_num_rows($dane);
			if ($ilosc>0)
			{
			
			if (isset($_POST['zmiennazwe']))

				{			
					$zmianaopis=$_POST['idalbumu'];
					mysqli_query($conn, "UPDATE `albumy` SET tytul='".$_POST['albumnazwa']."' WHERE albumy.id=".$zmianaopis."; ");
				
				}
			if (isset($_POST['usun']))
					{
						function removeDirectory($path) {
						$files = glob($path . '/*');
						foreach ($files as $file) {
							is_dir($file) ? removeDirectory($file) : unlink($file);
						}
						rmdir($path);
						return;
						}
						
						$usuwanieAlbumu=$_POST['idalbumu'];
						mysqli_query($conn, "DELETE albumy, zdjecia_komentarze, zdjecia_oceny, zdjecia
										FROM albumy 
										LEFT JOIN zdjecia
										ON zdjecia.id_albumu = albumy.id 
										LEFT JOIN zdjecia_komentarze
										ON zdjecia.id= zdjecia_komentarze.id_zdjecia
										LEFT JOIN zdjecia_oceny
										ON zdjecia.id = zdjecia_oceny.id_zdjecia 
										WHERE albumy.id =".$usuwanieAlbumu."");
										header ("Location: index.php?str=1");
										removeDirectory("../IMG/".$usuwanieAlbumu."");
					}				
						while ($wynik = mysqli_fetch_assoc($dane)) 
							{  
						
							$tytulAlbumu=$wynik['tytul'];
							$nazwaWlascicel=$wynik['login'];
							$DataDodania=$wynik['DataAlbumu'];
								
							echo '<div id="block">';
							echo '<div class="albumyz"><img src="../IMG/'.$wynik['IdAlbum'].'/'.$wynik['IdZdjecia'].'" width="180px"; height="180px"; text-align:center; />
							';
							echo "&nbsp&nbsp&nbsp";
							
						
						
							echo '<form method="POST" onsubmit="return confirm(\'Czy na pewno?\')" >
								<input type="submit" name="usun" style="cursor:pointer; background: #CC0033; height: 40px; width: 120px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
								value="Usuń album" >
							 
								 <input type="submit" name="zmiennazwe" style="cursor:pointer;background: #CC0033; height: 40px; width: 200px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
								 value="Zmień nazwę albumu" >
								 <br>
								 <br>
								 <input type="text" name="albumnazwa">
								 <input  id="idalbumu"  name="idalbumu" type="hidden" value="'.$wynik['IdAlbum']. '">
								 </form></div></div>';
							}
		}
		else echo "Brak albumów";
								
		}
		
		if ($_GET['str'] == 2)
		{
			echo '<center>
				<div id="naglowek6">
					Zdjęcia
					</div>
					<br>
					';
			
			echo '<center><br>
			<div id="pas"> 
			<a href="index.php?str=21"> Wszystkie albumy | </a>
			<a href="index.php?str=22"> Niezaakceptowane </a>
			<br><br>
			</div>';
		}
	
if (isset($_POST['usunZdj']))
						{
							$usuwanieZDJ=$_POST['idzdjecia'];
							mysqli_query($conn, "DELETE zdjecia, zdjecia_komentarze, zdjecia_oceny
										 FROM zdjecia 
										 LEFT JOIN zdjecia_komentarze
										 ON zdjecia.id= zdjecia_komentarze.id_zdjecia
										 LEFT JOIN zdjecia_oceny
										 ON zdjecia.id = zdjecia_oceny.id_zdjecia 
										 WHERE zdjecia.id =".$usuwanieZDJ."");
							header ("Location: index.php?str=21");
										 
								
						}
				
				if (isset($_POST['zmienopis']))

					{			
						$zmianaopis=$_POST['idzdjecia'];
						mysqli_query($conn, "UPDATE `zdjecia` SET opis='".$_POST['zdjecienazwa']."' WHERE zdjecia.id=".$zmianaopis."; ");
					}
	
if ($_GET['str'] == 21)
	
	{
		
		echo '<center>
				<div id="naglowek6">
					Zdjęcia
					</div>
					<br>
					';
					
					echo '<center>';
					
					
				$a=mysqli_query($conn, "SELECT * FROM albumy ;");
				$danea=mysqli_fetch_assoc($a);
				
				echo '<form action="index.php?str=21" method="POST"><select name="wyboralbumu">';
				while ($danea=mysqli_fetch_assoc($a))
				{
					echo  '<option value="' . $danea['id'] . '">' . $danea['tytul'] . '</option>';
				}
				echo '<input type=submit name="pokaz" value="Pokaż zdjęcia"></input></select></form>';
		
		
		if (isset($_POST['pokaz']))
		{
				echo '<br><div id="pas" style="color:black;">
					Moje zdjęcia
					</div>';
					
				echo '<br><br>';
				$zdjeciaa = mysqli_query($conn, "SELECT albumy.id AS IdAlbum, zdjecia.id AS zdjeciaID, tytul FROM albumy, zdjecia WHERE id_albumu=albumy.id AND zdjecia.id_albumu=albumy.id  AND albumy.id=".$_POST['wyboralbumu']."");
				
		
				while ($zdjecialista = mysqli_fetch_assoc($zdjeciaa)) 
					{  		
						echo '<div class="albumyz"><img src="../IMG/'.$zdjecialista['IdAlbum'].'/'.$zdjecialista['zdjeciaID'].'" width="180px"; height="180px"; text-align:center; />';
						echo "&nbsp&nbsp&nbsp";
			
						echo '<form method="POST" onsubmit="return confirm(\'Czy na pewno?\')" >
							<input type="submit" name="usunZdj" style="cursor:pointer;background: #CC0033; height: 40px; width: 120px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
							value="Usuń zdjęcie" >
						 
							 <input type="submit" name="zmienopis" style="cursor:pointer;background: #CC0033; height: 40px; width: 180px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
							 value="Zmień opis zdjęcia">
							 
							 
							 <br>
							 <br>
							 <input type="text" name="zdjecienazwa">
							 <input  id="idzdjecia"  name="idzdjecia" type="hidden" value="'.$zdjecialista['zdjeciaID']. '">
							 </form></div>';
					}
					
		}
	}
		
		
	if ($_GET['str'] == 22)
		{
				echo '<center><div id="naglowek6">
					Zdjęcia
					<br>
					</div>';
					
					echo '<br><center><div id="pas">
					Niezaakceptowane
					<br>
					</div>';
			
			
				$zdjeciaa = mysqli_query($conn, "SELECT id AS zdjeciaID, id_albumu AS IdAlbum FROM zdjecia WHERE zaakceptowane=0;");
				
					if (isset($_POST['usunZdj']))
						{
							$usuwanieZDJ=$_POST['idzdjecia'];
							mysqli_query($conn, "DELETE zdjecia, zdjecia_komentarze, zdjecia_oceny
										 FROM zdjecia 
										 LEFT JOIN zdjecia_komentarze
										 ON zdjecia.id= zdjecia_komentarze.id_zdjecia
										 LEFT JOIN zdjecia_oceny
										 ON zdjecia.id = zdjecia_oceny.id_zdjecia 
										 WHERE zdjecia.id =".$usuwanieZDJ."");
										 header ("Location: konto.php?str=22");
								
						}
				
				if (isset($_POST['zmienopis']))

					{			
						$zmianaopis=$_POST['idzdjecia'];
						mysqli_query($conn, "UPDATE `zdjecia` SET opis='".$_POST['zdjecienazwa']."' WHERE zdjecia.id=".$zmianaopis."; ");
					}
					
				if (isset($_POST['zaznacz']))
					{
						$akceptacja=$_POST['idzdjecia'];
						mysqli_query($conn, "UPDATE `zdjecia` SET zaakceptowane=1 WHERE zdjecia.id=".$akceptacja."; ");
						header ("Location: index.php?str=22");						
					}
				echo '<br>';
				while ($zdjecialista = mysqli_fetch_assoc($zdjeciaa)) 
			{  		
				echo '<div class="albumyz"><img src="../IMG/'.$zdjecialista['IdAlbum'].'/'.$zdjecialista['zdjeciaID'].'" width="180px"; height="180px"; text-align:center; />';
				echo "&nbsp&nbsp&nbsp";
			
				echo '<form method="POST">
					<input type="submit" name="usunZdj" style="cursor:pointer;background: #CC0033; height: 40px; width: 120px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
					value="Usuń zdjęcie" >
				 
					 <input type="submit" name="zmienopis" style="cursor:pointer;background: #CC0033; height: 40px; width: 180px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
					 value="Zmień opis zdjęcia" >
					 <br>
					 <br>
					 
					  <input type="submit" name="zaznacz" style="cursor:pointer;background: #CC0033; height: 25px; width: 120px;font-size:15px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
					 value="Zaakceptuj">
					 
					 <br>
					 <br>
					 <input type="text" name="zdjecienazwa">
					 <input  id="idzdjecia"  name="idzdjecia" type="hidden" value="'.$zdjecialista['zdjeciaID']. '">
					 </form></div>';
			}
		}
		
		if ($_GET['str'] == 3)
		{
			echo '<center>
				<div id="naglowek6">
					Komentarze
					</div>
					<br>
					';
			
			echo '<center><br>
			<div id="pas"> 
			<a href="index.php?str=31"> Wszystkie albumy | </a>
			<a href="index.php?str=32"> Niezaakceptowane </a>
			<br><br>
			</div>';
		}
		
		if ($_GET['str'] == 31)
		{
		echo '<center>
				<div id="naglowek6">
					Komentarze
					</div>
					<br>';
					
				
					
			{
					$komentarzedane = mysqli_query($conn, "SELECT zdjecia_komentarze.id as komID, id_zdjecia AS IDzdjecia, id_uzytkownika AS IDuzyt,	
														zdjecia_komentarze.data, komentarz, zaakceptowany, login 
														FROM zdjecia_komentarze, użytkownicy 
														WHERE użytkownicy.id=zdjecia_komentarze.id_uzytkownika
														Order by zdjecia_komentarze.data DESC");
					
					while ($komentarze = mysqli_fetch_assoc($komentarzedane))
							{
									echo "<div id='formularz1'>";
									echo "<br>Autor: ".$komentarze['login']."<br>" ;
									echo "<br>Data dodania: ".$komentarze['data']."<br> ";
									echo "<br>";
									echo '<form action="" method="POST">
										<input name="zdjecieId" type="hidden" value='.$komentarze['komID'].' />
										<textarea name="komentarzzdj" >'.$komentarze['komentarz'].'</textarea>
										<br>
										<input type="submit" name="usunKom" style="cursor:pointer;background: #CC0033; height: 30px; width: 150px;font-size:15px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
										value="Usuń komentarz" >';
										
									if($_SESSION['upr'] == "administrator")
											
											{											
												echo ' <button type="submit" name="wyslijKomentarz" title="Zmień komentarz" style="cursor:pointer;background: #CC0033; height: 30px; width: 150px;font-size:15px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);">
												Zmień komentarz</button>';
											}
													
									echo '</form>';
									echo "<div id='pasek'>" ;
									echo "</div>";
									echo "</div>";				
							}
							
							if (isset($_POST['wyslijKomentarz']))
								{
									mysqli_query($conn, "UPDATE `zdjecia_komentarze` SET komentarz='".$_POST['komentarzzdj']."', zaakceptowany=1  WHERE id=".$_POST['zdjecieId']."; ");
									header ("Location: index.php?str=31");
								}
							if (isset($_POST['usunKom']))
								{
									mysqli_query($conn, "DELETE FROM  zdjecia_komentarze WHERE id=".$_POST['zdjecieId']."; ");
									header ("Location: index.php?str=31");
								}

							
						
							
				
			}
		}
			
				if ($_GET['str'] == 32)
			{
				echo '<center>
				<div id="naglowek6">
					Komentarze niezaakceptowane
					</div>
					<br>';
			{
				echo '<center>';
					$komentarzedane = mysqli_query($conn, "SELECT zdjecia_komentarze.id as komID, id_zdjecia AS IDzdjecia, id_uzytkownika AS IDuzyt,	
														zdjecia_komentarze.data, komentarz, zaakceptowany, login 
														FROM zdjecia_komentarze, użytkownicy 
														WHERE użytkownicy.id=zdjecia_komentarze.id_uzytkownika AND zaakceptowany=0
														Order by zdjecia_komentarze.data DESC");
					
					while ($komentarze = mysqli_fetch_assoc($komentarzedane))
							{
									echo "<div id='formularz1'>";
									echo "<br>Autor: ".$komentarze['login']."<br>" ;
									echo "<br>Data dodania: ".$komentarze['data']."<br> ";
									echo "<br>";
									echo '<form action="" method="POST">
										<input name="zdjecieId" type="hidden" value='.$komentarze['komID'].' />
										<textarea name="komentarzzdj" >'.$komentarze['komentarz'].'</textarea>
										<br>
										<input type="submit" name="usunKom" style="cursor:pointer; background: #CC0033; height: 30px; width: 150px;font-size:15px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
										value="Usuń komentarz" >
										
										<button type="submit" name="wyslijKomentarz" title="Zmień komentarz" style="cursor:pointer; background: #CC0033; height: 30px; width: 150px;font-size:15px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);">
										Zmień komentarz</button>
									
										<input type="submit" name="zaznacz" style="cursor:pointer; background: #CC0033; height: 30px; width: 150px;font-size:15px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"
										value="Zaakceptuj">
										<br>
										</form>';
									echo "<div id='pasek'>" ;
									echo "</div>";
									echo "</div>";				
							}
							
							if (isset($_POST['wyslijKomentarz']))
								{
									mysqli_query($conn, "UPDATE `zdjecia_komentarze` SET komentarz='".$_POST['komentarzzdj']."', zaakceptowany=1  WHERE id=".$_POST['zdjecieId']."; ");
									
								}
							if (isset($_POST['usunKom']))
								{
									mysqli_query($conn, "DELETE FROM  zdjecia_komentarze WHERE id=".$_POST['zdjecieId']."; ");
									
								}
							if (isset($_POST['zaznacz']))
								{
									mysqli_query($conn, "UPDATE zdjecia_komentarze SET zaakceptowany=1 WHERE id=".$_POST['zdjecieId']."; ");
									
								}
			}
				}
				
		if ($_GET['str'] == 4)
		{
			echo '<center>
				<div id="naglowek6">
					Użytkownicy
					</div>
					<br>
					';
			
			echo '<center><br>
			<div id="pas" style="width: 75%; font-size:20px"> 
			<a href="index.php?str=41"> Wszyscy użytkownicy | </a>
			<a href="index.php?str=42"> Tylko użytkownicy |</a>
			<a href="index.php?str=43"> Tylko moderatorzy |</a>
			<a href="index.php?str=44"> Tylko administratorzy </a>
			<br><br>
			</div>';
		}
			
	if ($_GET['str'] == 41)
		{
			echo '<center>
				<div id="naglowek6">
					Użytkownicy
					</div>
					<br>
					';
					
			echo '<center><br>
			<div id="naglowek1"  style="width: 75%; font-size:20px; margin-left:100px;"> 
			<a href="index.php?str=41"> Wszyscy użytkownicy | </a>
			<a href="index.php?str=42"> Tylko użytkownicy |</a>
			<a href="index.php?str=43"> Tylko moderatorzy |</a>
			<a href="index.php?str=44"> Tylko administratorzy </a>
			<br><br>
			</div>';
			
			
				$uzytk = mysqli_query($conn, "SELECT * FROM użytkownicy order by login");
				echo '<br><table border=1><thead><th>LP.</th><th>Login</th><th>E-mail</th><th>Zarejestrowany</th><th>Uprawnienia</th><th>Aktywny</th></thead>';
				$i=1;
				while ($uzytko = mysqli_fetch_assoc($uzytk)) 
			{  		
			echo '<tr><td>'.$i.'</td><td>'.$uzytko['login'].'</td><td>'.$uzytko['email'].'</td><td>'.$uzytko['zarejestrowany'].'</td>
				<td><form action="index.php?str=41" method="POST"><select name="uprUzytk">
				<option '.(($uzytko['uprawnienia']=='użytkownicy') ? 'selected' :'').'>użytkownicy</option>
				<option '.(($uzytko['uprawnienia']=='moderator') ? 'selected' :'').'>moderator</option>
				<option '.(($uzytko['uprawnienia']=='administrator') ? 'selected' :'').'>administrator</option>
				</select></td>
				<td><select name="aktUzytk">
				<option '.(($uzytko['aktywny']==1) ? 'selected' :'').'>Aktywny</option>
				<option '.(($uzytko['aktywny']==0) ? 'selected' :'').'>Nie aktywny</option>
				</select></td>
				<td><button type="submit" name="akceptUzytk" title="Zaakceptuj zmiany" >Potwierdź zmiany</button>
				<input name="uzytkId" type="hidden"  value='.$uzytko['Id'].' /></form>
				<form action="" method="POST"  onsubmit="return confirm(\'Czy na pewno chcesz usunąć użytkownika?\')">
				<input name="uzytkId" type="hidden"  value='.$uzytko['Id'].' />
				<button type="submit" name="usunUzytk" title="Usuń użytkownika" >Usuń użytkownika</button>
				</form>
				</td>
				</tr>';
			$i++;
			}
			echo '</table>';
		
		if (isset($_POST['akceptUzytk']))
			{
				
				if ($_POST['aktUzytk']=="Aktywny")
				{
					mysqli_query($conn, "UPDATE użytkownicy SET `uprawnienia`='".$_POST['uprUzytk']."',`aktywny`=1 WHERE id=".$_POST['uzytkId']." ");
					//header("Location: index.php?str=4");	
				}
				else 
				{
					mysqli_query($conn, "UPDATE użytkownicy SET `uprawnienia`='".$_POST['uprUzytk']."',`aktywny`=0 WHERE id=".$_POST['uzytkId']." ");
					//header("Location: index.php?str=4");
				}
				
			}
			
		if (isset($_POST['usunUzytk']))
			{
				function removeDirectory($path) {
				$files = glob($path . '/*');
				foreach ($files as $file) {
					is_dir($file) ? removeDirectory($file) : unlink($file);
				}
				rmdir($path);
				return;
			}
		$albumyUzytkDane=mysqli_query($conn, "SELECT albumy.id AS albumyId 
										FROM albumy, użytkownicy
											WHERE albumy.id_uzytkownika=użytkownicy.id 
													AND użytkownicy.id=".$_POST['uzytkId']."
                                                    GROUP BY albumyId");
		$albumyUzytk= mysqli_fetch_assoc($albumyUzytkDane);
		$albumyUzytkLiczba= mysqli_num_rows($albumyUzytkDane);
		if ($albumyUzytkLiczba>0)
		{
				do{
						removeDirectory("../IMG/".$albumyUzytk['albumyId']."");
				}
				while($albumyUzytk= mysqli_fetch_assoc($albumyUzytkDane));
		}
	
		mysqli_query($conn, "DELETE albumy,zdjecia,zdjecia_komentarze, zdjecia_oceny, użytkownicy	
											FROM użytkownicy 
                                            LEFT JOIN albumy 
											ON użytkownicy.id= albumy.id_uzytkownika
											LEFT JOIN zdjecia 
											ON zdjecia.id_albumu = albumy.id 
                                            LEFT JOIN zdjecia_komentarze 
											ON zdjecia.id = zdjecia_komentarze.id_zdjecia
											LEFT JOIN zdjecia_oceny  
											ON zdjecia.id = zdjecia_oceny.id_zdjecia
											WHERE użytkownicy.id =".$_POST['uzytkId']."");
											//header("Location: index.php?str=4");	
	
	echo "<div id='komunikat'>Usunieto uzytkownika pomyslnie<br>
			<a href='javascript:history.back();'>Wróć do edycji użytkowników</a>
		 </div>";	
			}
		
		}
		include "admin-uzytkownicy.php";
		include "admin-moderatorzy.php";
		include "admin-administratorzy.php";
		echo '</div>';
?>
</body>
</html>