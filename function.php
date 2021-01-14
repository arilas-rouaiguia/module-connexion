<?php
require_once('bdd.php');
function redirect($destination){ // permet de centraliser les redirections au lieu d'en mettre partout et que ça créer des conflit
    header('Location: '. $destination);
}

function inscription($login, $nom, $prenom, $password, $confirm_password, $bdd){ // fonction inscriptin
    if(isset($_POST['register'])){
        $login = $_POST['login'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $errorLog = null;
        if(!empty($login) && !empty($nom) && !empty($prenom) && !empty($password) && !empty($confirm_password)){ // si les champs sont vides alors $errorLog

            $login_lenght = strlen($login);
            $nom_lenght = strlen($nom);
            $prenom_lenght = strlen($prenom);
            $password_lenght = strlen($password);
            $confirm_password_lenght = strlen($confirm_password);
            if(($login_lenght >=2) && ($nom_lenght >=2) && ($prenom_lenght >=2) && ($password_lenght  >=4) && ($confirm_password_lenght >=4)){ // si les champs n'ont pas assez de caractere alors $errorLog

                $query = mysqli_query($bdd, "SELECT login FROM utilisateurs WHERE login = '$login'");
                $count = mysqli_num_rows($query);

                if(!$count){ // si l'identifiant existe déjà alors $errorLog
                    if($confirm_password == $password) // si le mdp != confirm mdp alors $errorLog
                    {
                        $login = mysqli_real_escape_string($bdd,htmlspecialchars( trim($login))); // on enleve les espace, les \n -> string et caractere non affichable 
                        $nom = mysqli_real_escape_string($bdd, htmlspecialchars(trim($nom)));
                        $prenom = mysqli_real_escape_string($bdd, htmlspecialchars(trim($prenom)));
                        $password = mysqli_real_escape_string($bdd, htmlspecialchars(trim($password)));
                        $confirm_password = mysqli_real_escape_string($bdd, htmlspecialchars(trim($confirm_password)));
                        
                       
                        $cryptedpass = password_hash($password, PASSWORD_BCRYPT); // CRYPTED 
                        $insert = "INSERT INTO utilisateurs (login, nom, prenom, password) VALUES ('$login', '$nom', '$prenom', '$cryptedpass')";
                        mysqli_query($bdd,$insert);                 // insertion de l'inscription dans la $bdd
                        redirect('connexion.php'); // on configure la valeur de redirect qui est une variable de type string a la base
                    }
                else{
                    $errorLog = "Confirmation du mot de passe incorrect";
                    }
                }
            else{
                $errorLog = "Identifiant déjà existant";
                }
            }
            else{
                $errorLog = "login, nom , prenom doivent avoir 2 caracteres minimum, le mdp doit avoir 5 caracteres minimum";
            }
        }        
        else{
            $errorLog = "Champs non remplis";
            }
    }
    else{
        $errorLog = "Erreur inconnue";
        }   
    echo $errorLog;
}


//-------------------------------------------------------CONNEXION----------------------------------------------------------------------//
function connexion($login, $password, $bdd){
    $login = mysqli_real_escape_string($bdd, htmlspecialchars(trim($login))); // on enleve les espace, les \n -> string et caractere non affichable 
    $password = mysqli_real_escape_string($bdd, htmlspecialchars(trim($password)));
    $errorLog = null;
    
    if(!empty($login) && !empty($password)){ // il faut remplir les champs sinon $errorLog
            
        $verification = mysqli_query($bdd, "SELECT password FROM utilisateurs WHERE login = '$login' "); // on repere le mdp crypté a comparer avec celui entré par l'utilisateur
        $count = mysqli_num_rows($verification);
        $query_all = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login = '$login'"); // on récupère toutes les données pour les mettre dans une $_SESSION
        
        if($count){ // l'identifiant est - il reconnu par la bdd ? 
            $utilisateur = mysqli_fetch_assoc($query_all);
            $result = mysqli_fetch_assoc($verification);

            if(password_verify($password, $result['password'])){ 
                $_SESSION['connected'] = true;     
                $_SESSION['utilisateur'] = $utilisateur; // la carte d'identité de l'utilisateur à été créer et initialisé dans une $_SESSION
                if($login == 'admin'){  // Si l'identifiant est == admin  alors on créer une session qui lui permettra d'acceder la page admin
                    $_SESSION['admin'] = true;
                }
                else{
                    $_SESSION['admin'] = false; // sinon on emet un valeur pour etre sur qu'il n'y accedera pas par le header
                }
                redirect('profil.php');
            }
            else{
                $errorLog = "Mot de passe incorrect";
            }
        }
        else{
            $errorLog = "Identifiant incorrect";
        }
    }
    else{
        $errorLog = "Veuillez entrer des caracteres dans les champs";
    }
    echo $errorLog; // on aurait pu mettre un return mais flemme :-) pour un prochain projet

}

//--------------------------------------------------------------------PROFIL-----------------------------------------------------------------------------//

function profil($login, $password, $confirm_password, $bdd){

    $login = mysqli_real_escape_string($bdd, htmlspecialchars(trim($login))); // on enleve les espace, les \n -> string et caractere non affichable 
    $password = mysqli_real_escape_string($bdd, htmlspecialchars(trim($password)));
    $confirm_password = mysqli_real_escape_string($bdd, htmlspecialchars(trim($confirm_password)));
    $errorLog = null;

    if (!empty($login) && !empty($password) && !empty($confirm_password)) { // il faut entrer des modifications pour les appliquer 

        $login_lenght = strlen($login);
        $password_lenght = strlen($password);
        
        if(($login_lenght >=2) && ($password_lenght >=5)<=30){ // limitation du nbr de caractere minimum et maximum 
        
            $query = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE id = '$login'"); // on selectionne le bon utilisateur par rapport à sa connexion
            
            $fetch = mysqli_fetch_assoc($query);

            if($confirm_password == $password){     
        
                $cryptedpassword =  password_hash($password, PASSWORD_BCRYPT); // on recrypte le nouveau mdp 
                $utilisateur = $_SESSION['utilisateur']; 
                $update = mysqli_query($bdd,"UPDATE utilisateurs SET login = '$login', password = '$cryptedpassword' WHERE id = '". $utilisateur['id']. "'"); //update des identifiants
            }
            else{
                $errorLog = "Confirmation du mot de passe incorrect";
            }

        }
        else{
            $errorLog = "2 caractere minimum pour le login et 5 pour le mot de passe";
            }
    }
    else{
        $errorLog = "Veuillez entrer des caracteres dans les champs";
        }
        echo $errorLog;
}

?>