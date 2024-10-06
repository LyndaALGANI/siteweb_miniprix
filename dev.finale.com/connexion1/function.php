<?php
function ajouterUsers($nom, $prenom, $email, $adresse, $telephone, $password)
{
  if(require("config.php"))
  {
    $req = $db->prepare("INSERT INTO users (nom, prenom, email, adresse, telephone, password) VALUES (?, ?, ?, ?, ?, ?)");

    $req->execute(array($nom, $prenom, $email, $adresse, $telephone, $password));

    return true;

    $req->closeCursor();
  }
}