<?php

            $servname = 'localhost';
            $dbname = 'moduleconnexion';
            $user = 'root';
            $pass = '';
Try
{
	$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion;charset=utf8', 'root', '');
	//Je n'arrive pas a me connecter a ma base de donnée.
}
catch(Exception $e)
{
	die('Erreur' .$e->getMessage());
}