<?php

$message = "";

if(isset($_GET['action']) && $_GET['action'] == 'deco')
{
	//je déconnecte l'utilisateur
	session_destroy();
	header('location:index.php');
	exit;
}

//soumission du formulaire de connexion
if(!empty($_POST))
{
	include 'models/admin.php';
	
	$identifiant = $_POST['identifiant'];
	$pw = $_POST['pw'];
	
	//comparer avec ce que j'ai en bdd
	
	//aller chercher les infos de l'utilisateur/iden qui essaye de se connecter
	$admin = getAdminByIdentifiant($identifiant);
	
	//si l'identifiant existe dans la base alors âdmin contiendra les infos de cet admin
	
	//sinon $admin contiendra false
	
	if(!$admin)
	{
		$message = "Mauvais identifiant";
	}
	else
	{
		//vérifier le mot de passe
		if(password_verify($pw,$admin['password']))
		{
			//le mot de passe correcpond
			//connecter l'utilisateur
			$_SESSION['admin'] = $admin['first_name'].' '.$admin['last_name'];
			//redirige vers la page tableau de bord du backoffice
			
			if (!empty($_SESSION['url']))
			{
				$url = $_SESSION['url'];
				header("location:index.php?$url");
				exit;
			}
			else 
			{
				header('location:index.php?page=dashboard');
				exit;
			}
			
		}
		else
		{
			$message = "Mauvais mot de passe";
		}
	}
}



//afficher le formulaire de connexion
$template = 'views/admin.phtml';
include 'views/layout.phtml';