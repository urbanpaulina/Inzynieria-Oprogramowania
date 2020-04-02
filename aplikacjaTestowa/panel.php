<div id="menu">

<?php
include 'connect.php';

// trzeba pamietac aby za kazdym razem sprawdzac czy uzytkownik jest zalogowany oraz czy ma odpowiednie uprawnienia nadane 
// nadane przez zmienną sesyjną do przeglądania danych rzeczy 

if (isset ($_SESSION['zalogowany']) )
	{
		
			if ($_SESSION['typ_konta'] == 1)
			{
				echo '<a> Panel administacyjny</a><br>';
			
					echo '<a href = "dodawanieWykladowcow.php"> Dodaj wykladowcow</a><br>';
					echo '<a href = "zmianaUpr.php"> Zmien uprawnienia uzytkownikom</a><br>';
					echo '<a href = "wylogowanie.php"> Wyloguj</a><br>';
					
			}
			else if($_SESSION['typ_konta'] == 2)
			{
				echo '<a> Panel wykladowcy</a><br>';
			
				echo '<a href = "dodawanieStudentow.php"> Dodaj studentow</a><br>';
				echo '<a href = "dodawaniePytania.php"> Dodaj pytanie do bazwy</a><br>';
				echo '<a href = "stworzTest.php"> Stworzenie testu</a><br>';
				echo '<a href = "wylogowanie.php"> Wyloguj</a><br>';
				
			
			}
			else if($_SESSION['typ_konta'] == 3)
			{
				echo '<a> Panel studenta</a><br>';
			
				echo '<a href = "testy.php"> Rozwiaż test </a><br>';
				echo '<a href = "poprzednieTesty.php"> Zobacz swoje poprzednie testy</a><br>';
				echo '<a href = "nastepneTesty.php"> Zobacz nastepne testy do rozwiazania</a><br>';
				echo '<a href = "wylogowanie.php"> Wyloguj</a><br>';
				
			}
			
			
	}
	else
	{	
		echo '<a href="index.php">Zaloguj się  &nbsp;|  </a>';
	}	
?>
</div>
