<?php
require_once('bdd.php');
require_once('function.php');
$header = "Profil";
$header_css = "css/profil.css";

require_once("header.php");

if(isset($_POST['update'])){ // si on appuie sur le bouton update
    profil($_POST['login'], $_POST['password'],$_POST['confirm_password'], $bdd);
    echo "Changements effectués avec succès";
}
$utilisateur = $_SESSION['utilisateur'];
?>
<link rel="stylesheet" href="css/module-connexion.css">

<main class="main_profil">
    <section class="section_form">
        <h2 class="title_form">CHANGEMENT D'IDENTIFIANT</h2>
        <form action="" class="form_edited_profil" method="post">
            <div class="form_div">
                <label for="login">Login</label>
                <input type="text" id="login2" class="text" name="login" value="<?php echo $utilisateur['login']; ?>">
            </div>
            <div class="form_div">
                <label for="password">Mot de passe</label>
                <input type="password" id="password2" class="password" name="password">
            </div>
            <div class="form_div">
                <label for="confirm_password">Confirmer Mot de passe</label>
                <input type="password" id="confirm_password2" class="password" name="confirm_password">
            </div>
            <input type="submit" id="sub1" class="deco_main" name="update">
        </form>
    </section>

</main>
<?php

include "footer.php";

?>