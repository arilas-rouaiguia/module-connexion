<h1>Changer mon mot de passe</h1>
       <?php
      session_start();
      if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
      {
      ?>
       <form class=chatform method="post" action="changer_mdp.php">
      <p>
      <label for="pseudo">Votre nouveau mot de passe :</label><input type="password" name="mdp" id="mdp" required/>
      <br/>
      <label for="pseudoConfirm">Retapez votre nouveau mot de passe :</label><input type="password" name="mdpConfirm" id="mdpConfirm" required/>
      <br/>
     <input type="submit" value="Changer mon mot de passe">
     </form>
     <?php
     }
     else{
      echo '<p>Vous devez être connecté pour pouvoir changer votre mot de passe !</p>';
     }
     ?>