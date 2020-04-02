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
include 'menu.php';
$wybranyAlbumID = $_GET['album'];

$limit = 20;  
if (isset($_GET["strona"])) 
	{ 
		$strona  = $_GET["strona"]; 
	} 
		else 
	{ 
		$strona=1; 
	}; 
 
$start_od = ($strona-1) * $limit;		
$zdjeciaDane = mysqli_query($conn, "SELECT zdjecia.id AS zdjeciaID, tytul FROM albumy,`zdjecia` WHERE zdjecia.id_albumu=albumy.id AND albumy.id='".$wybranyAlbumID."' AND zaakceptowane=1 LIMIT $start_od, $limit");
$zdjeciaWynik = mysqli_fetch_assoc($zdjeciaDane);


echo '<div id="formularz">';
echo "Tytuł albumu: <br>".$zdjeciaWynik['tytul'] ; 
echo "<br>";
echo '<br>';

 do 
	{  
		echo '&nbsp&nbsp<a href="foto.php?album='.$wybranyAlbumID.'&wlasciciel='.$_GET['wlasciciel'].'&zdjecie='.$zdjeciaWynik['zdjeciaID'].'"><img src="img/'.$wybranyAlbumID.'/'.$zdjeciaWynik['zdjeciaID'].'" width="180px" height="180px"/></a>';
	}
 
	while ($zdjeciaWynik= mysqli_fetch_assoc($zdjeciaDane));

$zdjeciaDaneWynik= mysqli_query($conn, "SELECT zdjecia.id AS zdjeciaID FROM albumy,`zdjecia` WHERE zdjecia.id_albumu=albumy.id 	AND albumy.id='".$wybranyAlbumID."' AND zaakceptowane=1");    
$zdjeciaIlosc = mysqli_num_rows($zdjeciaDaneWynik);   
$maxStron = ceil($zdjeciaIlosc / $limit);
echo "</div>";
echo "<div id='formularz'>";
echo '<a href="galeria.php?strona=1&sortowaniegaleria=1"><button style="background: #CC0033; height:50px; width:180px;font-size:15px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59);
																background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);
																	background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);
																		background: linear-gradient(top, #CC0033, #FF3366);"> Powrót do poprzedniej strony</button></a>';
echo "<br>";
echo "<br>";
echo "<br>";

$linkStrona="";

$poprzedniaStrona = "<a href='album.php?strona=".($strona-1)."&album=".$_GET['album']."&wlasciciel=".$_GET['wlasciciel']." &stronagaleria=".$_GET['stronagaleria']."&sortowaniegaleria=".$_GET['sortowaniegaleria']." '>Poprzednia strona</a>&nbsp&nbsp&nbsp&nbsp" ;  
$nastepnaStrona = "<a href='album.php?strona=".($strona+1)."&album=".$_GET['album']."&wlasciciel=".$_GET['wlasciciel']."&stronagaleria=".$_GET['stronagaleria']."&sortowaniegaleria=".$_GET['sortowaniegaleria']."'>Nastepna strona</a>" ;

if ($strona!=1 )
	{
		echo $poprzedniaStrona;
	}
	
for ($i=1; $i<=$maxStron; $i++) 
		{  
			if ($maxStron>1)
				{
					$linkStrona .= "<a href='album.php?strona=".$i."&album=".$_GET['album']."&wlasciciel=".$_GET['wlasciciel']."&stronagaleria=".$_GET['stronagaleria']."&sortowaniegaleria=".$_GET['sortowaniegaleria']." '>".$i."</a> &nbsp&nbsp&nbsp&nbsp";
				}
		};  
echo $linkStrona; 

if($strona!=$maxStron )
	{
		echo  $nastepnaStrona; 
		echo "</div>";
	}
echo '</div>';
?>
</body>
</html>