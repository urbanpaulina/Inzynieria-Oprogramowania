<?php
include '../connect.php';
if ($_GET['str'] == 43)
		{
			echo '<center>
				<div id="naglowek6">
					Użytkownicy
					</div>
					<br>
					';
					
			echo '<center><br>
			<div id="naglowek1" style="width: 75%; font-size:20px; margin-left:100px;"> 
			<a href="index.php?str=41"> Wszyscy użytkownicy | </a>
			<a href="index.php?str=42"> Tylko użytkownicy |</a>
			<a href="index.php?str=43"> Tylko moderatorzy |</a>
			<a href="index.php?str=44"> Tylko administratorzy </a>
			<br><br>
			</div>';
			
			
				$uzytk = mysqli_query($conn, "SELECT * FROM użytkownicy where uprawnienia='moderator' order by login");
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
					//header ("Location: index.php?str=41");	
				}
				else 
				{
					mysqli_query($conn, "UPDATE użytkownicy SET `uprawnienia`='".$_POST['uprUzytk']."',`aktywny`=0 WHERE id=".$_POST['uzytkId']." ");
					//header ("Refresh: 0");	
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
	
	echo "<div>Usunieto uzytkownika pomyslnie</div>";	
			}
		
		}
		
?>		