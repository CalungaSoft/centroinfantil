<?php
	$hostname="localhost";
	$user="root";
	$password="";
	$database="escola";
	
	$conexao=mysqli_connect($hostname,$user,$password,$database,3333);
	mysqli_set_charset($conexao, 'utf8')
	 
?>