<?php


function getAdminByIdentifiant($identifiant)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT password, first_name, last_name 
	FROM admin 
	WHERE email = ?");
	
	$query -> execute([$identifiant]);
	
	$admin= $query -> fetch(PDO::FETCH_ASSOC);
	
	return $admin;
}