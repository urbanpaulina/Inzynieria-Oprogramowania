<?php

		include 'connect.php';

// jeśli ustawiony jest button o przycisku logowanie			
if(isset($_POST['logowanie']))
	{
		// przypisujemy do zmiennych wartości przekazane z posta z formularza
				$login = $_POST['loginPost'];
				$haslo = $_POST['hasloPost'];
			
				// do zmiennej przypisujemy wyniki polecenia sql
				$fetch = mysqli_query($conn, "SELECT * FROM uzytkownicy WHERE login = '" . $login . "' AND haslo='" .md5($haslo). "';");
				//te dane musimy przekonwertować na dane zrozumiane dla php podaną niżej funkcją
				$dane = mysqli_fetch_assoc($fetch);
				// teraz możemy wyciągać poszczególne dane i przypisywać je do zmiennych
				$typ_konta = $dane['typ_konta']; // przypisujemy do zmiennej phpowskiej dane z kolumny z sql o nazwie typ_konta
				
				$imie = $dane['Imie'];
				$nazwisko = $dane['Nazwisko'];
				$email=$dane['email'];
				$uczelnia_id = $dane['uczelnia_id'];
				

		
			if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM uzytkownicy WHERE haslo = '".md5($haslo)."';")) > 0)
			{
				if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM uzytkownicy WHERE login = '" . $login . "' AND  haslo = '".md5($haslo)."';")) > 0)
				{	
					if($dane['typ_konta']==1) // jesli zalogowany jestes jako admin to...
					{	
					
					//rozpoczynamy sesję
						session_start();
						
								$_SESSION['zalogowany']=1; // zmienna ktora bedziemy sprawdzac czy jest 1 w innych plikach, aby zablokowac nieuprawniony dostep do stron.
								$_SESSION['login']=$login;
								$_SESSION['haslo']=$haslo;
								$_SESSION['typ_konta'] = 1 ;
								$_SESSION['Imie'] = $imie;
								$_SESSION['Nazwisko'] = $nazwisko;
								$_SESSION['email'] = $email;
								$_SESSION['uczelnia_id'] = $uczelnia_id;
								
								header("Location: panel.php");
								
								echo " Zalogowałeś się poprawnie na konto. Witamy admina ";
								echo '<br>';
								echo "Imie: " . $imie . " " . "Nazwisko: " . $nazwisko;
					}
					else if($dane['typ_konta']==2) // jesli zalogowany jestes jako wykladowca to...
					{	
						session_start();
								
								$_SESSION['zalogowany']=1; // zmienna ktora bedziemy sprawdzac czy jest 1 w innych plikach, aby zablokowac nieuprawniony dostep do stron.
								$_SESSION['login']=$login;
								$_SESSION['haslo']=$haslo;
								$_SESSION['typ_konta'] = 2 ;
								$_SESSION['Imie'] = $imie;
								$_SESSION['Nazwisko'] = $nazwisko;
								$_SESSION['email'] = $email;
								$_SESSION['uczelnia_id'] = $uczelnia_id;
								header("Location: panel.php");
								echo " Zalogowałeś się poprawnie na konto. Witamy wykladowce ";
								echo "Imie: " . $imie . " " . "Nazwisko: " . $nazwisko;
					}
					else if($dane['typ_konta']==3) // jesli zalogowany jestes jako student to...
					{	
					
						$nr_indeksu=$dane['nr_indeksu'];
						$grupa_id = $dane['grupa_id'];
						
						
						session_start();
								
								$_SESSION['zalogowany']=1; // zmienna ktora bedziemy sprawdzac czy jest 1 w innych plikach, aby zablokowac nieuprawniony dostep do stron.
								$_SESSION['login']=$login;
								$_SESSION['haslo']=$haslo;
								$_SESSION['typ_konta'] = 3 ;
								$_SESSION['Imie'] = $imie;
								$_SESSION['Nazwisko'] = $nazwisko;
								$_SESSION['email'] = $email;
								$_SESSION['nr_indeksu'] = $nr_indeksu;
								$_SESSION['grupa_id'] = $grupa_id;
								$_SESSION['uczelnia_id'] = $uczelnia_id;
								
								header("Location: panel.php");
								
								echo " Zalogowałeś się poprawnie na konto. Witaj studencie ";
								echo '<br>';
								echo "Imie: " . $imie . " " . "Nazwisko: " . $nazwisko . " " . "Nr indeksu: " . $nr_indeksu;
					}
					else header("Location: index.php?err=12");
				}
				else header("Location: index.php?err=10");
			}
			else header("Location: index.php?err=13");
				
	}
	
	
?>

