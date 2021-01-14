<?php
$header = "admin";
$header_css = "css/admin.css";
require_once('bdd.php');
$users = array();
if(isset($_SESSION['utilisateur'])){
    $query = mysqli_query($bdd, "SELECT * FROM utilisateurs");
    $users = mysqli_fetch_all($query);
}

require_once("header.php"); // once pour éviter les conflit
?>

<main class="main_admin">
    <section>
        <h1 class="title_form">ADMIN</h1>
    </section>
    <section id="right">
        <table class="tableau_admin">
            <tr>
                <th class="tableau_admin">ID</th>
                <th class="tableau_admin">LOGIN</th>
                <th class="tableau_admin">NOM</th>
                <th class="tableau_admin">PRENOM</th>
                <th class="tableau_admin">MOT DE PASSE</th>
            </tr>
            <?php
                  foreach ($users as $key){
                      echo "<tr>";
                      foreach ($key as $value){
                          echo "<td class='tableau_admin'>$value</td>";
                      }
                      echo "</tr>";
                  }
              ?>
        </table>

    </section>
    <section id="left">
    </section>
</main>
<?php
$footer = "css/admin.css";

include "footer.php";

?>