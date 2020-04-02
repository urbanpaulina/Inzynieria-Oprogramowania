<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="CSS/style.css" type="text/css">
<title>
</title>
</head>
<body>
<br>

<?php
include 'connect.php';
include 'menu.php';

?>
<div id="naglowek">
Dodawanie albumu
</div>
<div id="formularz"> 
		<form action="dodaj-album.php" method="post">
			Podaj nazwe albumu: <input type="text" name="nazwa_albumu" ><br><br>
			<input type="submit" name="Dodaj_album" value="Dodaj" style="cursor:pointer;background: #CC0033; height: 40px; width: 80px;font-size:19px;font-family:Palatino Linotype, bold;color:white;
																			border: 2px solid rgba(33, 68, 72, 0.59); background: -webkit-linear-gradient(top, #CC0033, #FF3366);
																				background: -moz-linear-gradient(top, #CC0033, #FF3366);background: -o-linear-gradient(top, #CC0033, #FF3366);
																					background: -ms-linear-gradient(top, #CC0033, #FF3366);background: linear-gradient(top, #CC0033, #FF3366);">
		</form>
</div>
<br>
<div id="echo">
	<?php	
			if(isset($_POST['Dodaj_album']))
			{
				$nazwa=trim($_POST['nazwa_albumu']);
		
						if(strlen($nazwa) > 2 || strlen($nazwa)>100)
							{
								session_start();
								mysqli_query($conn, "INSERT INTO `albumy` (`tytul`, `data`, `id_uzytkownika`) VALUES ('".$nazwa."' ,'".date('Y-m-d H:i:s')."', '".$_SESSION['Id']."');");
								$nz= mysqli_insert_id ( $conn );
								mkdir ("IMG/$nz", 0777);
								$_SESSION['nzS']=$nz;
								header("Location: dodaj-foto.php?album=$nz&wlasciciel=".$_SESSION['Id']."");
							}
							else echo 'Nazwa jest za krótka';			
			}
			
					
		echo '<br><a href="index.php">Powrót</a>';
			
				
	?>
</div>
</body>
</html>
