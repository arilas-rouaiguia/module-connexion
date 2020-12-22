<?php

 require_once 'inscription.php';
 
 if(isset($_POST['nom'])&& isset($_POST['prenom']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password_retype']))
	{
		$nom = htmlspecialchars($_POST ['nom']);
		$prenom = htmlspecialchars($_POST ['prenom']);
		$login = htmlspecialchars($_POST ['login']);
		$password = htmlspecialchars($_POST ['password']);
		$password_retype = htmlspecialchars($_POST ['password_retype']);
		
	 	$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion;charset=utf8', 'root', '');
		
	 	$check = $bdd->prepare('SELECT prenom, nom, login, password FROM utilisateurs WHERE login = ?');
		//Je bloque totalement, le php m'indique aucune erreur, a l'exception que rien ne s'enregistre dans la base de donnée, je ne vois pas mon erreur :/  	
		$check->execute(array($login));
		$data = $check ->fetch();
		$row = $check->rowCount();
		
		if($row == 0)
		{
			if(strlen($nom) <= 100)
			{
				if (strlen($prenom) <= 100)
				{
					if (strlen($login) <= 100)
					{	
							if(strlen($login) <= 100)
						{
							if($password == $password_retype)
							{
								$password = hash('sha526', $password); //L'erreur vient d'ici, quelque chose ne fait pas le lien.
								$insert = $bdd->prepare('INSERT INTO utilisateurs(login, prenom, nom, password) VALUES(:login, :prenom, :nom, :password)');
								$insert->execute(array(
								'nom' => $nom,
								'prenom' => $prenom,
								'login' => $login,
								'password' => $password
								));
								header('Location: inscription.php?reg_err=success');
							}
						}else header ('Location: inscription.php?reg_err=login'); 
					}else header ('Location: inscription.php?reg_err=login_lenght');
				}else header ('Location: inscription.php?reg_err=prenom_lenght');
			}else header ('Location: inscription.php?reg_err=nom_lenght');
		}else header ('Location: inscription.php?reg_err=already');		
	}