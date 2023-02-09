<?php 
      session_start();
      include 'includes/database.php'; //connexion à la bdd
      if(isset($_SESSION['email'])){
          header('Location: miniChat.php');
          exit();
      }
?>

<?php

      if (isset($_POST['formulaireConnexion'])){
          $email_formulaire = htmlspecialchars(trim($_POST['email']));
          $mdp_formulaire= htmlspecialchars(trim($_POST['mdp']));

          if (!empty($email_formulaire) && !empty($mdp_formulaire)) {
                //include 'includes/database.php'; //connexion à la bdd

                $req = $bd-> prepare("SELECT mdp from utilisateurs where email = :email ");
                $req ->bindValue(':email',$email_formulaire);
                $req->execute();
                $res = $req->fetch(PDO::FETCH_ASSOC);
                //S'il y a une correspondance
                if($res) {
                  //Si le hachage  est le même que celui du mdp, si les mdp se correspondent
                  if(password_verify($mdp_formulaire,$res['mdp'])){
                      
                      //chargement de la SESSION de l'utilisateur 

                      $_SESSION['connecte'] = true;
                      $_SESSION['email'] = $email_formulaire;//cookies
                      $_SESSION['mdp'] = $mdp_formulaire;  
                      if ($_SESSION['email'] == $email_formulaire) {
                      
                        header('Location: miniChat.php');
                        exit();
                      }
                      else {
                        header('Location: connexion.php');
                        exit();
                      }

                  }//fin du if verif mdp
                  else{
                      $erreur = 'Votre email ou votre mot de passe est incorrecte.';
                      //le mdp est incorrecte, pour des raisons de sécurité et de differences entre les navigateurs, mettre "email et mdp incorrect" 
                  } 
              }//fin du if correspondance
              else{
                      $erreur = 'Votre email ou votre mot de passe est incorrecte.'; 
                      //l'email est incorrecte, pour des raisons de sécurité et de differences entre les navigateurs, mettre "email et mdp incorrect" 
                  } 
            
        }//fin if email et mdp ne sont pas vides
        else {
            $erreur = 'Tous les champs doivent être remplis.';
        }

    }//fin grand if
?>


  <!-- lien de la fiche de style css 
  <link rel="stylesheet" type="text/css" href="Ressources_css/connexion.css">
   script de la fiche JS 
  <script src="Ressources_js/mdp-visible.js"></script> -->


<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="Ressources_css/connexion.css" media="screen" type="text/css" />
        <title>Page de connexion</title>
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="connexion.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Email: </b></label>
                <input type="text" placeholder="Entrer l'email de l'utilisateur" name="email">

                <label><b>Mot de passe: </b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="mdp" >
                  <?php if (isset($erreur)) {
                      echo'<p><font color="#A50505">'. $erreur. '</font> </p>';
                  }?>
                <input type="submit" id='submit' value='SE CONNECTER' name="formulaireConnexion" >
                
            </form>
            <div><a href="inscription.php"><input type="submit" id='submit_inscription' value='INSCRIPTION' name="formulaireInscription"></a> </div>
        </div>
    </body>



