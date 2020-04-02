<?php
@SESSION_Start();
			$conn = mysqli_connect("localhost", "root", "", "wypych_4Ta");
			mysqli_query($conn, 'SET NAMES utf8');
			mysqli_query($conn, 'SET CHARACTER SET utf8');
			mysqli_query($conn, "SET collation_connection = utf8_polish_ci");
?>