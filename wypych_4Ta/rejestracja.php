<?php
			$conn = mysqli_connect("localhost", "root", "", "wypych_4Ta");
			mysqli_query($conn, 'SET NAMES utf8');
			mysqli_query($conn, 'SET CHARACTER SET utf8');
			mysqli_query($conn, "SET collation_connection = utf8_polish_ci");
			
			if(isset($_POST['Zarejestruj']))
	{
				$login = $_POST['login'];
				$haslo = $_POST['haslo'];
				$haslo2 = $_POST['haslo2'];
				$email = $_POST['email'];
				$d = $b['uprawnienia'];
				
				
				

				
				
			
			
			
if ($haslo == $haslo2)
			
	{
	if (strlen($login) >= 5)
{
	if ( strlen($haslo) >= 5)
	{
		if (mysqli_num_rows(mysqli_query($conn, "SELECT login FROM użytkownicy WHERE login = '".$login."';")) == 0)
		{
				if (preg_match('/[A-Z]/', $haslo))
				{
					if (preg_match('/[0-9]/', $haslo))
					{
						if (preg_match('/[a-z]/', $haslo))
						{
								if(!preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $login))
									{
								mysqli_query($conn, "INSERT INTO `użytkownicy` (`login`, `haslo`, `email` , `zarejestrowany` , `uprawnienia` , `aktywny`) VALUES ('".$login."', '".md5($haslo)."', '".$email . "','".date('Y-m-d H:i:s')."', 'użytkownik', '1');");
								
								// mysqli_query($conn, "SELECT * FROM `użytkownicy` (
								
								session_start();
								$_SESSION['sllogin']=$login;
								$_SESSION['shaslo']=$haslo;
								$_SESSION['semail']=$email;
								$_SESSION['a'] = 1 ;
								$_SESSION['uprawnienia']= $d;
								$_SESSION['upr']=$b['uprawnienia'];
								$_SESSION['Id']= $e;
								$_SESSION['a'] = 1;
								$_SESSION["Id"]= mysqli_insert_id ( $conn );
								
								header("Location: rejestracja-ok.php");
								echo " Gratulacje konto zostało utworzone";
								
									}
							else header("Location: index.php?err=1");
						}
					else header("Location: index.php?err=3");
					}
				else header("Location: index.php?err=4");
				}
			else header("Location: index.php?err=5");
		}
		else header("Location: index.php?err=6");
	}
	else header("Location: index.php?err=7");
	}
else header("Location: index.php?err=8");
}
else header("Location: index.php?err=9");
	
	}
?>
			
			
		
