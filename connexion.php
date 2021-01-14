<?php
require_once('bdd.php');

$header = "Connexion";
$header_css = "css/connexion.css";

require_once('function.php');

if(isset($_POST['connect'])){
    connexion($_POST['login'], $_POST['password'], $bdd);
}
require_once("header.php");
?>
<link rel="stylesheet" href="css/module-connexion.css">
<main class="main_connexion">
    <section class="section_form">
        <h1 class="title_form">CONNEXION</h1>
        <form action="connexion.php" class="form_edited" method="post">
            <div class="form_div">
                <label for="login">Login</label>
                <input type="text" id="id1" class="text" name="login">
            </div>

            <div class="form_div">
                <label for="password">Mot de passe</label>
                <input type="password" id="id2" class="password" name="password">
            </div>
            <div>
                <input type="submit" id="sub1" class="deco_main" name="connect">
                <!-- bouton personnalisé W3school CSS3 -->
            </div>
            <!-- <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password"> -->
        </form>
    </section>
</main>
<?php
$footer = "css/connexion.css";

include "footer.php";

?>