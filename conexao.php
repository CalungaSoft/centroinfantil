<?php
	$hostname="localhost:3333";
	$user="root";
	$password="";
	$database="centroinfantil";
	
	$conexao=mysqli_connect($hostname,$user,$password,$database);
	mysqli_set_charset($conexao, 'utf8')
	 
?>