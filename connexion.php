<?php
  //connexion à la base de données
  $con = mysqli_connect("{Host}","{username}","{password}","{Database}");
  if(!$con){
     echo "Vous n'êtes pas connecté à la base de donnée";
  }
?>