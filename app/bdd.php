<?php
	//connecter à la base de données
	$bdd = new PDO('mysql:host=db.3wa.io;dbname=guilhemdenis_blog;charset=utf8','guilhemdenis','32a2e2fc52188a0c291f18ef03420277');
	$bdd -> query	("SET lc_time_names = 'fr_FR'");