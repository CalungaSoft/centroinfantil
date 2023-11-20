<?php
	$hostname="localhost";
	$user="root";
	$password="";
	$database="centroinfantil";
	
	$conexao=mysqli_connect($hostname,$user,$password,$database);
	mysqli_set_charset($conexao, 'utf8')
	 
?>