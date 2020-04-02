<?php
	@SESSION_Start();
	//Łączenie z bazą       localhost    użytk  hasło  nazwa bazy
			$conn = mysqli_connect("localhost", "root", "", "testingdatabase");
			mysqli_query($conn, 'SET NAMES utf8');
			mysqli_query($conn, 'SET CHARACTER SET utf8');
			mysqli_query($conn, "SET collation_connection = utf8_polish_ci");
?>