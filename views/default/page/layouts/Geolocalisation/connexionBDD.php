<?php
	try
		{
		$bdd = new PDO('mysql:host=localhost;dbname=vitrydb', 'root', '');
		}
		catch(Exception $e)
		{
		  die('Erreur : '.$e->getMessage());
		}
?>
