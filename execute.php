<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Execute</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
       if(isset($_POST['button'])){
            extract($_POST);
            include_once "connexion.php";
            try {
                $querry = $con->prepare($sqlCommand);  
                $querry->execute();

                if(str_contains(strtolower($sqlCommand), "select")) {
                    $resultSet = $querry->get_result();
                    $data = $resultSet->fetch_all(MYSQLI_ASSOC);
                    $message = "";
                    $successmessage = "";
                    foreach ($data as $row) {
                        if(isset($row["id"])) { $successmessage .= $row['id'] . "    |"; }
                        $successmessage .= $row['username'] . "    |    ";
                        if(isset($row["password"])) { $star = "";for ($i=0; $i < strlen($row['password']); $i++) { $star .= "*"; } $successmessage .= $star . "    |    "; }
                        if(isset($row["ppUrl"])) { $successmessage .= $row['ppUrl']; }
                        $successmessage .= "<br>";
                    }
                } else {
                    $successmessage = "Command execute with success.";
                }
            } catch (Exception $e) {
                $message = $e->getMessage();   
            }
       }
    
    ?>
    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Execute command</h2>
        <p class="erreur_message">
            <?php 
            // si la variable message existe , affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <p class="success_message">
            <?php 
            // si la variable message existe , affichons son contenu
            if(isset($successmessage)){
                echo $successmessage;
            }
            ?>
        </p>
        <form action="" method="POST">
            <label>Command</label>
            <input type="text" id="text" name="sqlCommand"> 
            <input type="submit" value="Execute" name="button">
        </form>
    </div>
</body>
<script type="text/javascript">
    function add(value) {
        var text = document.getElementById('text');
        text.value += value;
    }
</script>
</html>