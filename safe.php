<?php
	session_start();
	require_once 'config.php'; 
	
	if(isset($_POST['login']) && isset($_POST['password']))
	{
		$login = htmlspecialchars($_POST['login']);
		$password = htmlspecialchars($_POST['password']);
		
		$check = $bdd->prepare('SELECT pseudo, password FROM utilisateurs WHERE pseudo = ?');
		$check->execute(array($login));
		$data = $check->fetch();
		$row = $check->rowCount();
		
	
		
        if($row == 1)
        {
            if(filter_var($login))
            {
                $password = hash('sha256', $password);
                if($data['password'] === $password)
                {
                    $_SESSION['id'] = $data['login'];
                    header('Location: changermdp.php');
                    die();
                }else{ header('Location: index.php?login_err=password'); die(); }
            }else{ header('Location: index.php?login_err=email'); die(); }
        }else{ header('Location: index.php?login_err=already'); die(); }
    }