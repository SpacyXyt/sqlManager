<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
       if(isset($_POST['button'])){
           extract($_POST);
           if(isset($username) && isset($password) && $url){
                //connexion à la base de donnée
                include_once "connexion.php";
                $id = $con->query("SELECT COUNT(*) FROM account");
                $req = $con->query("INSERT INTO account (username, password, ppUrl) VALUES ('$username', '$password', '$url')");
                if($req){
                    header("location: index.php");
                }else {
                    $message = "Compte non ajouté";
                }

           }else {
               //si non
               $message = "Veuillez remplir tous les champs !";
           }
       }
    
    ?>
    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Ajouter un compte</h2>
        <p class="erreur_message">
            <?php 
            // si la variable message existe , affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>

        </p>
        <form action="" method="POST">
            <label>Username</label>
            <input type="text" name="username">
            <label>Password</label>
            <input type="password" name="password">
            <label>PPUrl</label>
            <input type="text" name="url">
            <input type="submit" value="Ajouter" name="button">
        </form>
    </div>
</body>
</html>