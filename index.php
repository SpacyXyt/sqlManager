<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des compte</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="buttonTop">
            <a href="ajouter.php" class="Btn_add"> <img src="images/plus.png"> Add</a>
            <a href="execute.php" class="Btn_add"> <img src="images/plus.png"> Command</a>
        </div>
        
        <table>
            <tr id="items">
                <th>Id</th>
                <th>Username</th>
                <th>Password</th>
                <th>Photo de profil</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                <th>Show password</th>
            </tr>
            <?php 
                include_once "connexion.php";
                $req = $con->query("SELECT * FROM account");
                if(mysqli_num_rows($req) == 0){
                    
                    $message = "Il n'y a pas encore de compte enregister!" ;
                    
                }else {
                    while($row=mysqli_fetch_assoc($req)){
                        ?>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['username']?></td>
                            <td><p id="password2" class="pass active"><?php $star = "";for ($i=0; $i < strlen($row['password']); $i++) { $star .= "*"; } print($star); ?></p><p id="password" class="pass"><?php print($row['password']); ?></p></td>
                            <td><p style="overflow: scroll; width: 20vh;"><?=$row['ppUrl']?></p></td>
                            <td><a href="modifier.php?id=<?=$row['id']?>"><img src="images/pen.png"></a></td>
                            <td><a href="supprimer.php?id=<?=$row['id']?>"><img src="images/trash.png"></a></td>
                            <td>
                                <div onclick="toggle('icon')" id="icon" class="show">
                                    <ion-icon name="eye-outline" class="icon"></ion-icon>
                                    <ion-icon name="eye-off-outline" class="nonactive"></ion-icon>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    
                }
            ?>
      
         
        </table>

        <?php if(isset($message)) { echo "<br><br>" . $message; } ?>
   
   
   
   
    </div>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script type="text/javascript">
    function toggle(id) {
        var el = document.getElementById(id);
        var pass = document.getElementById("password");
        var pass2 = document.getElementById("password2");

        el.classList.toggle("active");
        pass.classList.toggle("active");
        pass2.classList.toggle("active");
    }
</script>
</html>