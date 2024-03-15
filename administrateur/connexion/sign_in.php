<?php

$admin_credentials = ['username' => 'admin', 'password' => 'admin'];

if (!empty($_POST)) {

  if (isset($_POST['password']) && isset($_POST['username']) && !empty($_POST['username']) && !empty($_POST['password'])) {

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if ($username == $admin_credentials['username'] && $password == $admin_credentials['password']) {
      session_start();
      $_SESSION['is_admin'] = true;
      header('Location: /gestion-benevole/administrateur/index.php');
      exit;
    } else {
      $_SESSION['is_admin'] = false;
      header("Location: /gestion-benevole/administrateur/connexion/index.php?message=Identifiants non valides. Veuillez réesayez.");
      exit;
    }
  }
}
