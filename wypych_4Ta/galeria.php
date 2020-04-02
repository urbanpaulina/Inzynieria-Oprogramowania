<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="CSS/style.css" type="text/css">
<title>
</title>
</head>
<body>
<?php
include 'menu.php';

echo "
	<div id='naglowek'>
	Galeria
	</div>
	<br>
	<br>";

$_SESSION['sort'] = (isset($_GET['sort'])) ? $_GET['sort'] : "tytul";

		$s = $_SESSION['sort'];
		
		 if ($_GET['sort'] == "DataAlbumu")
		{
			$_SESSION['sRodzaj'] = "DESC";
		}
		else
		{
			$_SESSION['sRodzaj'] = "ASC";
		}
		
	$limit =20;
		if (isset($_GET["strona"])) 
			{ 
				$strona  = $_GET["strona"]; 
			} 
		else 
			{ 
				$strona=1; 
			};  

	$start_od = ($strona-1) * $limit;
	$daneWynik= mysqli_query($conn, "SELECT DISTINCT albumy.id FROM albumy, zdjecia WHERE albumy.id = zdjecia.id_albumu AND zdjecia.zaakceptowane AND zdjecia.zaakceptowane=1  ");    
	$daneIlosc = mysqli_num_rows($daneWynik);   
	$maxStron = ceil($daneIlosc / $limit); 

 
$linkStrona="";
$poprzedniaStrona = "<a href='galeria.php?strona=".($strona-1)."&sort=$s'>Poprzednia strona</a>" ;
$nastepnaStrona = "<a href='galeria.php?strona=".($strona+1)."&sort=$s'>Nastepna strona</a>" ;

		if ($strona!=1 )
			{
				echo '<div id="formularz1">' ;
				echo $poprzedniaStrona;
				echo '</div>';
			}
			
			for ($i=1; $i<=$maxStron; $i++) 
				{  
					if ($maxStron>1)
						{
							$linkStrona .= "<a href='galeria.php?strona=".$i."&sort=$s '>".$i."</a> &nbsp&nbsp&nbsp&nbsp";  
						}
            
				}; 
				
		echo '<div id="formularz1">' ;

		if($strona!=$maxStron )
			{
				echo '<div id="formularz1">' ;
				echo  $nastepnaStrona; 
				echo '</div>';
			}

			echo "<br>Sortuj według: <a href='galeria.php?page=".$strona."&sort=login'>Nick</a>| <a href='galeria.php?page=".$strona."&sort=DataAlbumu'> Data </a> | <a href='galeria.php?page=".$strona."&sort=tytul'> Tytuł  </a><br>";
  
	if ($maxStron>1)
		{
			echo  $linkStrona;
		}
 echo '</div>';
 echo '<br>';


	echo "<div id='formularz1'>";

	$dane = mysqli_query($conn, "	SELECT albumy.id AS IdAlbum , tytul , albumy.data AS DataAlbumu ,
		min(zdjecia.id) AS IdZdjecia , login, użytkownicy.id AS IdWlasc 
		FROM albumy,`zdjecia`, użytkownicy WHERE id_albumu=albumy.id 
		AND albumy.id_uzytkownika=użytkownicy.id 
		AND zaakceptowane=1 group by albumy.id ORDER BY $s ". $_SESSION['sRodzaj'] ." LIMIT $start_od, $limit");  	


	while ($wynik = mysqli_fetch_assoc($dane)) 
		{  
			$tytulAlbumu=$wynik['tytul'];
			$nazwaWlascicel=$wynik['login'];
			$DataDodania=$wynik['DataAlbumu'];
		
	echo '<a class="tooltipTextLink" href="album.php?album='.$wynik['IdAlbum'].'&wlasciciel='.$wynik['IdWlasc'] .'&stronagaleria='.$strona.'&sortowaniegaleria='.$s.'" >
	<img src="IMG/'.$wynik['IdAlbum'].'/'.$wynik['IdZdjecia'].'" width="180px"; height="180px"; text-align:center; />
	<span class="tooltipText">Tytuł albumu: '.$tytulAlbumu.'<br>Autor: '.$nazwaWlascicel.'<br>Data utworzenia:<br/>'.$DataDodania.'</span></a>';
	echo "&nbsp&nbsp&nbsp";
	
	
	
	};


 
?>

		
		<div id="stopka">
			
		Autor: Mateusz Wypych kl. 4 Ta
		
		</div>

</body>
</html>