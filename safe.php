<?php
	session_start();
	require_once 'config.php'; 
	
	if(isset($_POST['login']) && isset($_POST['password']))
	{
		$login = htmlspecialchars($_POST['login']);
		$password = htmlspecialchars($_POST['password']);
		
		$check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE pseudo = ?');
		$check->execute(array($login));
		$data = $check ->fetch();
		$row = $check->rowCount();
		
	
		
		if($row == 1) //l'erreur doit aussi ce produire ici.
		{
			if(filter_var($login, FILTER_VALIDATE_EMAIL))
			{
				$password = hash('sha256',$password);
			}else header('Location:connexion.php?login_err=login');
		}else header('Location:connexion.php?login_err=already');
	}else header('Location:connexion.php');