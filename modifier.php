<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

         //connexion à la base de donnée
          include_once "connexion.php";
         //on récupère le id dans le lien
          $id = $_GET['id'];
          //requête pour afficher les infos d'un employé
          $req = $con->query("SELECT * FROM account WHERE id = $id");
          $row = mysqli_fetch_assoc($req);


       //vérifier que le bouton ajouter a bien été cliqué
       if(isset($_POST['button'])){
           //extraction des informations envoyé dans des variables par la methode POST
           extract($_POST);
               //requête de modification
               $req = $con->query("UPDATE account SET username = '$username' , password = '$password' , id = '$id', ppUrl = '$url' WHERE id = $id");
                if($req){//si la requête a été effectuée avec succès , on fait une redirection
                    header("location: index.php");
                }else {//si non
                    $message = "Employé non modifié";
                }
       }
    
    ?>

    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Modifier le compte: <?=$row['username']?> </h2>
        <p class="erreur_message">
           <?php 
              if(isset($message)){
                  echo $message ;
              }
           ?>
        </p>
        <form action="" method="POST">
            <label>username</label>
            <input type="text" name="username" value="<?=$row['username']?>" required>
            <label>Password</label>
            <input type="password" name="password" value="<?=$row['password']?>" required>
            <label>Id</label>
            <input type="text" name="id" value="<?=$row['id']?>" required>
            <label>ppUrl</label>
            <input type="text" name="url" value="<?=$row['ppUrl']?>" required>
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</body>
</html>