<?php
require_once('bdd.php');
require_once('function.php');
if(isset($footer)){
    $footer = 'default';
}
if(isset($footer_css)){
    $footer_css = 'default';
}
if(isset($_SESSION['utilisateur'])){
$utilisateur = $_SESSION['utilisateur'];
}

echo "
    <link rel='stylesheet' href='css/footer.css'>
<footer class='footer_common'>";
    if(isset($_SESSION['connected'])){
        echo "<p class='coucou'> Bonjour ". $utilisateur['login'] . "</p>"; // si on est connecté la class coucou nous fait coucou :-)
    }
    
    if(isset($_SESSION['connected']) && $_SESSION['connected']){ // si on est connecté le bouton deconnexion apparait
        echo" <form method='POST' action='deconnexion.php'>
         <input type='submit' class='deco' name='deconnexion' value='DECONNEXION'> 
         </form>";
        
    }
    echo"  
    </article>
</footer>
</body>
</html>";

?>