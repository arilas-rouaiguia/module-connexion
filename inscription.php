<?php
require_once('bdd.php');

$header = "inscription";
$header_css = "css/inscription.css";
require_once('function.php');

if(isset($_POST['register'])){
    inscription($_POST['login'], $_POST['nom'], $_POST['prenom'], $_POST['password'], $_POST['confirm_password'], $bdd);
}
require_once("header.php");
?>
<link rel="stylesheet" href="css/module-connexion.css">

<main class="main_inscription">
    <section class="section_form">
        <h1 class="title_form">Inscription</h1>
        <form action="inscription.php" class="form_edited" method="post">
            <label for="login">Identifiant</label>
            <input type="text" id="login1" class="text" name="login">

            <label for="nom">Nom</label>
            <input type="text" id="nom2" class="text" name="nom">

            <label for="prenom">Prenom</label>
            <input type="text" id="prenom3" class="text" name="prenom">

            <label for="password">Mot de passe</label>
            <input type="password" id="password4" class="password" name="password">

            <label for="confirm_password">Confirmer le mot de passe</label>
            <input type="password" id="confirm_password5" class="password" name="confirm_password">

            <input type="submit" id="sub1" class="deco_main" name="register"> <!-- Bouton vert -->
			
        </form>
    </section>
</main>
<?php

$footer = "css/admin.css";

include "footer.php";

?>