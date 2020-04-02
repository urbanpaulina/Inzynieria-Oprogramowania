<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="CSS/style.css" type="text/css">
	</head>
	<title>Wstawianie</title>
	<body>
	
		<div id="naglowek">

		Witaj w panelu logowania	
		
		</div>
		
<form action="logowanie.php" method="POST">
			<div id="naglowek1">
			Logowanie:<br><br>
			</div>
			<br>
			<br>
			<div id="formularz"> 
			Login: <input type="text" name="loginPost" maxlength="20"><br><br>
			Hasło: <input type="password" name="hasloPost" maxlength="20"><br><br>
			<input type="submit" value="Zaloguj!" name="logowanie">
			</div>
		</form>
		
		<?php
		
if(isset($_GET['err']))
	{
		switch ($_GET['err'])
		{
			case 1;
				echo "W loginie występują niedozwolone znaki";
				break;
			case 2;
				echo "W haśle występują niedozwolone znaki";
				break;
			case 3;
				echo "W haśle nie ma małych liter";
				break;
			case 4;
				echo "W haśle nie ma cyfr";
				break;
			case 5;
				echo "W haśle nie ma dużych liter";
				break;
			case 6;
				echo "Login istnieje";
				break;
			case 7;
				echo "Hasło jest za krótkie";
				break;
			case 8;
				echo "Login jest za krótki";
				break;
			case 9;
				echo "Hasła są różne";
				break;
			case 10;
				echo "Nie ma takiego użytkownika";
				break;
			case 12;
				echo "Konto użytkownika zostało zablokowane.";
				break;
			case 13;
				echo "Hasło użytkownika jest nieprawidłowe.";
				break;
		}
	}	
?>
		
		
		<div id="stopka">
			
	
		
		</div>
	
	
		
		
	</body>
	</html>