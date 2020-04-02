<?php
include 'connect.php';


if (isset ($_SESSION['zalogowany']) )
	{
		
			if ($_SESSION['typ_konta'] == 1)
			{

					echo '<a> Panel administacyjny</a><br>';
			
					echo '<a href = "dodawanieWykladowcow.php"> Dodaj wykladowcow</a><br>';
					echo '<a href = "zmianaUpr.php"> Zmien uprawnienia uzytkownikom</a><br>';
					echo '<a href = "wylogowanie.php"> Wyloguj</a><br>';
					
					// pokaz wszystkich wykladowcow z uczelni ktorej jest admin 
					
					$dane= mysqli_query($conn, "SELECT DISTINCT Imie,Nazwisko,email FROM uzytkownicy where uczelnia_id= '".$_SESSION['uczelnia_id']."' and typ_konta=2 ");    
 
					
					echo '<br>';
					echo 'Lista wykladowcow';
					echo '<br>';
					
					while ($wynik = mysqli_fetch_assoc($dane)) // dopóki istnieją użytkownicy ... 
						{  
							$Imie=$wynik['Imie'];
							$Nazwisko=$wynik['Nazwisko'];
							$email=$wynik['email'];
							
							echo "Imie: " . $Imie . " " . "Nazwisko: " . $Nazwisko. " " . "Email: " . $email;
							echo '<br>';
							
						}			
					
			}
	}
	
					

					

?>


<br><br>

<form action="dodajWyklad.php" method="POST">
			<div id="naglowek1">
			Dodaj Wykładowce:<br><br>
			</div>
			<br>
			<br>
			<div id="formularzDodawania"> 
			Imie: <input type="text" name="imiePost" maxlength="20"><br><br>
			Nazwisko: <input type="text" name="nazwiskoPost" maxlength="20"><br><br>
			email: <input type="text" name="emailPost" maxlength="50"><br><br>
			<input type="submit" value="Dodaj!" name="dodawanie">
			</div>
		</form>