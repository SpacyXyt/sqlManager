<?php
  //connexion a la base de données
  include_once "connexion.php";
  //récupération de l'id dans le lien
  $id= $_GET['id'];
  //requête de suppression
  $req = $con->query("DELETE FROM account WHERE id = $id");
  //redirection vers la page index.php
  header("Location:index.php")
?>