<?php 
      session_start();
      include 'includes/database.php'; //connexion à la bdd
      //si j'ai déjà une session
      if(isset($_SESSION['email'])){
            header('Location: miniChat.php');
            exit();
      }

?>

<?php    
     //On se place sur le bon formulaire : "name" de la balise <input> dans id="btn"
    if (isset($_POST['formulaireInscription'])){
        //trim supprime les espaces en début et fin de chaine 

        $pseudo = htmlspecialchars(trim($_POST['pseudo'])); 
        $nom = htmlspecialchars(trim($_POST['nom'])); 
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $email = htmlspecialchars(strtolower(trim($_POST['email'])));
        $mdp= htmlspecialchars(trim($_POST['mdp']));
    

        //si les variables ne sont pas vide
        if (!empty($pseudo) && !empty($nom) && !empty($prenom) && !empty($email) && !empty($_POST['email2']) && !empty($mdp) && !empty($_POST['mdp2'])) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) { //si l'email est valide, filter_var renvoie les données filtrées
                if ($email == $_POST['email2']){ //si les deux emails se correspondent
                   
                   $reqmail = $bd->prepare('SELECT * from utilisateurs where email = ?');
                   $reqmail->execute([$email]);
                   $mailexist = $reqmail->fetch();
                   if (!$mailexist) {  //si email n'est pas déjà utilisé dans la bdd, on peut continuer le formulaire
                      if (iconv_strlen($mdp,"UTF-8")>= 8){ //si la longueur du mdp est >= 8
                          if ($mdp == $_POST['mdp2']){ //si les deux mdp se correspondent
                            $options = [
                              'cost' => 13,  //on fait le hachage, ici c'est le coût algorithmique
                            ];

                            $hashmdp = password_hash($mdp, PASSWORD_BCRYPT, $options); //création de la clé de hachage 

                            $req = $bd-> prepare("INSERT INTO utilisateurs(pseudo,nom,prenom,email,mdp) VALUES (:pseudo,:nom,:prenom,:email,:mdp)");
                            $req->execute(array(
                              'pseudo' => $pseudo,
                              'nom' => $nom,
                              'prenom' => $prenom,
                              'email' => $email,
                              //'mdp' => $mdp,
                            ));
                              header('Location:connexion.php');
                              exit;
                              //$erreur = 'L\'inscription est réussie tu peux te connecter';
                          }// fin if (mdp==mdp2)
                          else {
                              $erreur = "Les mots de passes ne sont correspondent pas.";
                          }
                      }//fin minimum 8 caractères pour le mdp
                      else{
                         $erreur = "Votre mot de passe doit contenir au minimum 8 caractères";
                      }                

                   }//fin if mailexist
                   else {
                        $erreur = "Cette adresse mail est déjà utilisée.";
                   }
                
                }//fin if email = email2 correspondent
                else {
                  $erreur = "Les deux emails ne se correspondent pas.";
                }
            }//fin if filter_var
            else {
                  $erreur = "L'adresse mail est invalide.";
            }
        }//fin du if verification des champs non vide: nom n'est pas vide...
        else {
          $erreur = "Les champs doivent être tous remplis.";
        }
    }//fin du grand if isset
        
?>
  

<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="Ressources_css/inscription.css" media="screen" type="text/css" />
        <title>Page d'inscription</title>
    </head>
    <body>
        <div id="container">
            <!-- zone d'inscription' -->
            
            <form action="inscription.php" method="POST">
                <h1>Inscription</h1>
                
                <span><label><b>Pseudo </b></label></span>
                <input type="text" placeholder="Entrer le pseudo de l'utilisateur" name="pseudo" required value="<?php if(isset($pseudo)){ echo $pseudo;}?>">

                <span><label><b>Prenom </b></label></span>
                <input type="text" placeholder="Entrer le prénom de l'utilisateur" name="prenom" required value="<?php if(isset($prenom)){ echo $prenom;}?>">

                <span><label><b>Nom </b></label></span>
                <input type="text" placeholder="Entrer le nom de l'utilisateur" name="nom" required value="<?php if(isset($nom)){ echo $nom;}?>">

                 <span><label><b>Email</b></label></span>
                 <input type="text" name="email" placeholder="Entrez votre email" required value="<?php if(isset($email)){ echo $email;}?>">

                 <span><label><b>Confirmation email</b> </label></span><br>
                 <input type="text retape" name="email2" placeholder="Confirmez votre email" required>

                <br>
                <span><label><b>Mot de passe (minimum 8 caractère) </b></label></span>
                <input type="password" placeholder="Entrer le mot de passe" name="mdp" required>


                <span><label><b>Confirmation du mot de passe </b></label></span>
                <input type="password" name="mdp2" placeholder="Confirmez votre mot de passe" required>

                 <?php if (isset($erreur)) {
                    echo'<p><font color="#A50505">'. $erreur. '</font> </p>';
                }?>

                <input type="submit" id='submit_inscription' value="JE M'INSCRIS" name="formulaireInscription" href="connexion.php" >
                
            </form>
        </div>
    </body>


