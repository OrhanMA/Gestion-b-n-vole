<?php

require_once __DIR__ . '../../../classes/CsvManager.php';

if (!empty($_POST)) {
  if (empty($_POST['code']) == true) {
    // si aucun code n'est soumis dans le formulaire
    header('Location: /gestion-benevole/benevole/connexion/failure.php?message="code is empty');
    exit;
  } else {
    $code = htmlspecialchars($_POST['code']);
    //récupération des bénévoles dans le csv
    $csv = new CsvManager('./../../csv/benevoles.csv');
    $file = $csv->openCsv();
    $csv->readCsv();
    $benevoles = $csv->readFromCsv();

    //variable vide pour y mettre le bénévole si on le trouve par la suite
    $user_found;
    foreach ($benevoles as $benevole) {
      // ajouter la bénévole dans la variable $user_found si son ID correspond au code soumis
      $benevole_id = $benevole[0];
      if ($benevole_id == $code) {
        $user_found = $benevole;
      }
    }
    $csv->closeCsv($file);
    // redirige selon si user trouvé ou pas
    if (!empty($user_found)) {
      print_r($user_found);
      header("Location: /gestion-benevole/benevole/index.php?code=$code");
      exit;
    } else {
      print_r('no user found');
      header('Location: /gestion-benevole/benevole/connexion/failure.php?message="Invalid credentials"');
      exit;
    }
  }
} else {
  // si post est empty, renvoi à la page d'erreur
  header('Location: /gestion-benevole/benevole/connexion/failure.php?message="post is empty"');
  exit;
}

