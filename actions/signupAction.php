<?php

require('actions/database.php');

//Verifier si l'utilisateur a bien completer tous les champs
if (isset($_POST['validate'])) {

  //Validation du formulaire
  if (!empty($_POST['pseudo']) and !empty($_POST['lastname']) and !empty($_POST['frirstname']) and !empty($_POST['password'])) {

    //Les donnes de l'user
    $user_pseudo = htmlspecialchars($_POST['pseudo']);
    $user_lastname = htmlspecialchars($_POST['lastname']);
    $user_frirstname = htmlspecialchars($_POST['frirstname']);
    $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //Verfier si l'utilisateur existe deja sur le site
    $checkIfuserAlreadyExists = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
    $checkIfuserAlreadyExists->execute(array($user_pseudo));

    if ($checkIfuserAlreadyExists->rowCount() == 0) {

      //Inserer l'utilisateur dans la bdd
      $insertUserOnWebsite = $bdd->prepare('INSERT INTO users(pseudo, nom, prenom, mdp)VALUE(?, ?, ?, ?)');
      $insertUserOnWebsite->execute(array($user_pseudo, $user_lastname, $user_frirstname, $user_password));

      //Recuprer les informations de l'utilisateur
      $getInfosOfThisUserReq = $bdd->prepare('SELECT id, pseudo, nom, prenom FROM users WHERE nom = ? AND prenom = ? AND pseudo = ?');
      $getInfosOfThisUserReq->execute(array($user_lastname, $user_frirstname, $user_pseudo));

      $usersInfos = $getInfosOfThisUserReq->fetch();

      //Autentifier l'utilisateur sur le site 
      $SESSION['auth'] = true;
      $SESSION['id'] = $usersInfos['id'];
      $SESSION['lastname'] = $usersInfos['nom'];
      $SESSION['frirstname'] = $usersInfos['prenom'];
      $SESSION['pseudo'] = $usersInfos['pseudo'];

      //Rediriger l'utilisateur vers la page d'acceuil
      header('location: index.php');
    } else {
      $errorMsg = "L'utilisateur existe déja sur le site";
    }
  } else {
    $errorMsg = "Veuiller compléter tous les champs...";
  }
}
