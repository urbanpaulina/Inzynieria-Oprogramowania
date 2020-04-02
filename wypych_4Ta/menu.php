<div id="menu">

<?php
include 'connect.php';
if (isset ($_SESSION['a']) )
	{
		echo '<a href="dodaj-album.php" id="a">Załóż album|    </a>';
		
		if (isset ($_GET['album']) )
			{
				if(isset($_GET['wlasciciel']) && $_GET['wlasciciel']==$_SESSION['Id'])
				{
						echo '<a href="dodaj-foto.php?album='.$_GET['album'].'&wlasciciel='.$_GET["wlasciciel"].'">Dodaj zdjęcie|    </a>';
				}	
			}
		echo '<a href="top-foto.php">Najlepiej oceniane|    </a>';
		echo '<a href="nowe-foto.php">Najnowsze|    </a>';
		echo '<a href="konto.php?str=1">Moje konto|    </a>';
		echo '<a href="galeria.php">Galeria   |</a>';
		echo '<a style="color:#CC0033;float:right;" href="wylogowanie.php">Wyloguj się   &nbsp</a>';
		
		
		
			if ($_SESSION['upr'] == 'administrator' || $_SESSION['upr'] == 'moderator')
			{
			echo '<a href="admin/index.php?str=0"> Panel administacyjny</a><br>';
			}
	}
	else
	{	
		echo '<a href="index.php">Załóż album &nbsp;|   </a>';
		echo '<a href="index.php">Zaloguj się  &nbsp;|  </a>';
		echo '<a href="index.php">Rejestracja  &nbsp;|  </a>';
	}	
?>
</div>
