<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="CSS/style.css" type="text/css">
	</head>
	<title>Wstawianie</title>
	<body>
			<?php
					include 'menu.php';
			?>
		<div id="naglowek">

		Witaj w panelu rejestracji i logowania	
		
		</div>
			
		<div id="formularz"> 
		<center>
	
		<div id="naglowek1"> Rejestracja </a>
		</div>
		<br>
		<br>
		<form action="rejestracja.php" method="post">
		Podaj login (nick): <input type="text" name="login" maxlength="20"><br><br>
		Podaj hasło: <input type="password" name="haslo" maxlength="20"><br><br>
		Potwierdź hasło: <input type="password" name="haslo2"  maxlength="20"><br><br>
		Email: <input type="text" name="email"><br><br>
		<input type="submit" name="Zarejestruj" value="Zarejestruj" style="cursor:pointer;background: #CC0033; height: 40px; width: 120px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);">
		</div>
		</form>
		<br>
		<br>
		<center>
		</div>
		
		<div id="echo">
		
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
</div>
		
		<br>
		<br>
		

<form action="logowanie.php" method="POST">
			<div id="naglowek1">
			Logowanie:<br><br>
			</div>
			<br>
			<br>
			<div id="formularz"> 
			Login: <input type="text" name="llogin" maxlength="20"><br><br>
			Hasło: <input type="password" name="lhaslo" maxlength="20"><br><br>
			<input type="submit" value="Zaloguj!" name="logowanie" style="cursor:pointer;background: #CC0033; height: 40px; width: 120px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);"><br><br>
			</div>
		</form>
		
		<div id="stopka">
			
		Autor: Mateusz Wypych kl. 4 Ta
		
		</div>
	
	
		
		
	</body>
	</html>