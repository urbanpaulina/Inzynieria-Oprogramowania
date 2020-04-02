<?php
			$conn = mysqli_connect("localhost", "root", "", "wypych_4Ta");
			mysqli_query($conn, 'SET NAMES utf8');
			mysqli_query($conn, 'SET CHARACTER SET utf8');
			mysqli_query($conn, "SET collation_connection = utf8_polish_ci");
			
if(isset($_POST['logowanie']))
	{
				$llogin = $_POST['llogin'];
				$lhaslo = $_POST['lhaslo'];
			
				
				$a = mysqli_query($conn, "SELECT * FROM użytkownicy WHERE login='" . $llogin . "' AND haslo='" .md5($lhaslo). "';");
				$b = mysqli_fetch_assoc($a);
				$c = $b['aktywny'];
				$d = $b['uprawnienia'];
				$e = $b['Id'];
				$f = $b['email'];

		
			if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM użytkownicy WHERE haslo = '".md5($lhaslo)."';")) > 0)
			{
				if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM użytkownicy WHERE login = '$llogin'  AND  haslo = '".md5($lhaslo)."';")) > 0)
				{	
				
					if($b['aktywny']==1)
					{	
						session_start();
						
								$_SESSION['sllogin']=$llogin;
								$_SESSION['s1haslo']=$lhaslo;
								$_SESSION['a'] = 1 ;
								$_SESSION['uprawnienia']= $d;
								$_SESSION['Id']= $e;
								$_SESSION['upr']=$b['uprawnienia'];
								$_SESSION['semail']=$f;
								
							
								
								
								header("Location: galeria.php");
								echo " Zalogowałeś się poprawnie na konto";
					}
					else header("Location: index.php?err=12");
				}
				else header("Location: index.php?err=10");
			}
			else header("Location: index.php?err=13");
				
	}
	
	
?>

