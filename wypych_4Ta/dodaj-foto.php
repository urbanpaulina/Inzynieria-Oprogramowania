<!DOCTYPE HTML>
<html>
	<head>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="CSS/style.css" />
</head>
<?php
include 'menu.php';
 ?>
 <body>
 <br>

 <div id="naglowek">Dodaj zdjęcie</div>
 
		<div id="formularz">
			<form action = "dodaj-foto.php?album=<?php echo $_GET['album'] ; ?>&wlasciciel=<?php echo $_GET['wlasciciel'] ; ?>" method = "POST" enctype = "multipart/form-data">
				Opis do zdjęcia
				<br>
				<textarea rows="6" cols="40" name="opis" ></textarea>
				<br>
				<br>
				<input type = "file" name = "image" />
				<br>
				<br>
				<input type = "submit" value="Wyślij" style="cursor:pointer;background: #CC0033; height: 40px; width: 80px;font-size:19px;font-family:Palatino Linotype, bold;color:white;border: 2px solid rgba(33, 68, 72, 0.59);
																background: -webkit-linear-gradient(top, #CC0033, #FF3366);background: -moz-linear-gradient(top, #CC0033, #FF3366);
																	background: -o-linear-gradient(top, #CC0033, #FF3366);background: -ms-linear-gradient(top, #CC0033, #FF3366);
																		background: linear-gradient(top, #CC0033, #FF3366);"></div>
			</form>
	  
<?php
		include 'connect.php';
		include_once 'class.img.php';
	

	if(isset($_FILES['image']))
	{
	  
     if ($_FILES['image']['error'] == UPLOAD_ERR_OK && strstr($_FILES['image']['type'],"image"))
		{
		 $img= new Image($_FILES['image']['tmp_name']);
		 $opis = trim($_POST['opis']);
		 mysqli_query ($conn, "INSERT INTO zdjecia (opis, id_albumu, data,`zaakceptowane`) VALUES ('" . $opis . "','". $_GET['album'] ."' ,'".date('Y-m-d H:i:s')."', '0' );");
		 $idZdj = mysqli_insert_id( $conn ); 
		 $img->SetMaxSize(1200);
         $img->Save('IMG/' . $_GET['album'] . '/' . $idZdj);
		 echo "<div id='formularz'> Gratulacje! Dodałeś zdjęcie do albumu. <br> </div>";
		 
		}
	  
		elseif($_FILES['image']['error'] == UPLOAD_ERR_NO_FILE)
			{
				echo "<div id='echo'>Nie wybrano pliku.</div>";
			}
		else	
			{
			echo "<div id='echo'>Wystąpił błąd podczas dodawania zdjęcia, spróbuj ponownie <br></div>";
			}
	}
		
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
$dodajZdjecieDane = mysqli_query($conn, "SELECT zdjecia.id AS zdjeciaID, tytul FROM `albumy`,`zdjecia` WHERE zdjecia.id_albumu=albumy.id And albumy.id='".$_GET['album']."'LIMIT $start_od, $limit");
$dodajZdjecieDaneWynik = mysqli_fetch_assoc($dodajZdjecieDane);


if ($dodajZdjecieDaneWynik!=0)
	{
		echo   "<div id='formularz'> Tytuł albumu: ".$dodajZdjecieDaneWynik['tytul']."<br><br></div>" ; 
	do 
		{  
			echo '<img src="IMG/'.$_GET['album'].'/'.$dodajZdjecieDaneWynik['zdjeciaID'].'" width="180px" height="180px"/> &nbsp ';
		
		}
	while ($dodajZdjecieDaneWynik = mysqli_fetch_assoc($dodajZdjecieDane));

	$dodajZdjecieWynik= mysqli_query($conn, "SELECT zdjecia.id AS zdjeciaID FROM `albumy`,`zdjecia` WHERE zdjecia.id_albumu=albumy.id AND albumy.id='".$_GET['album']."' ");    
	$dodajZdjeciaIlosc = mysqli_num_rows($dodajZdjecieWynik);   
	$maxZdjec = ceil($dodajZdjeciaIlosc / $limit);

	$linkStrona="";
		
		echo '<div id="formularz">';
	
	$poprzedniaStrona = "<a href='dodaj-foto.php?strona=".($strona-1)."&album=".$_GET['album']."&wlasciciel=".$_GET['wlasciciel']."'>Poprzednia strona</a> &nbsp&nbsp&nbsp&nbsp" ;
	$nastepnaStrona = "<a href='dodaj-foto.php?strona=".($strona+1)."&album=".$_GET['album']."&wlasciciel=".$_GET['wlasciciel']."'>Nastepna strona</a>" ;
		if ($strona!=1 )
			{
				echo $poprzedniaStrona;
			}
			
		for ($i=1; $i<=$maxZdjec; $i++) 
			{  
             $linkStrona .= "<a href='dodaj-foto.php?strona=".$i."&album=".$_GET['album']."&wlasciciel=".$_GET['wlasciciel']." '>".$i."</a> &nbsp&nbsp&nbsp&nbsp";  
			};  

	echo $linkStrona;
	
		if($strona!=$maxZdjec )
			{
				echo  $nastepnaStrona; 
			}
	}
else echo '<div id="formularz"> W albumie nie ma jeszcze żadnych zdjęć </div>';
	"<br>";
	echo '</div>';
?>
      
   </body>
</html>
