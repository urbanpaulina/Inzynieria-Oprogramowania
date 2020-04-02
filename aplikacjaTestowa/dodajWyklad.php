<?php

include 'connect.php';


if (isset ($_SESSION['zalogowany']) )
	{
		
			if ($_SESSION['typ_konta'] == 1)
			{

				if(isset($_POST['dodawanie']))	// jesli kliknelismy dodaj wykladowce to
				{
					
					$imie = $_POST['imiePost'];
					$nazwisko = $_POST['nazwiskoPost'];
					$email = $_POST['emailPost'];
					
					$login = $imie . "." . $nazwisko;
					
					mysqli_query($conn, "INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `typ_konta`, `Imie`, `Nazwisko`, `email`, `uczelnia_id`, `nr_indeksu`, `grupa_id`) 
					VALUES (NULL, '" . $login . "', 'test', '2', '" . $imie . "', '" . $nazwisko . "', '" . $email . "', '".$_SESSION['uczelnia_id']."', NULL, NULL);");
					header("Location: dodawanieWykladowcow.php");
					echo 'Dodano poprawnie wykladowce';
				}
			}
	}



?>