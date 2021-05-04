<?php
if(!isset($_SESSION['admin']))
{
    $_SESSION['url'] = $_SERVER['QUERY_STRING'];
	header('location:index.php?page=admin');
	exit;
}

include 'models/writers.php';

$writers = getAllWriters();

//récupération des données du formulaire d'ajout d'article
if (isset($_GET['idModif']))
{
    $writer = getWriterbyId($_GET['idModif']);
    if (!empty($_POST))
    {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $pseudo = $_POST['pseudo'];
        
        updateWriters($firstName, $lastName,$pseudo, $email, $_GET['idModif']);
    	header('location:index.php?page=writers');
    	exit;
    }
}
else
{
    if (!empty($_POST))
    {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $pseudo = $_POST['pseudo'];
        
        addWriters($firstName, $lastName, $pseudo, $email);
    	header('location:index.php?page=writers');
    	exit;
    }
}










$template = "new_writer.phtml";
include 'views/layout.phtml';