<?php

require_once __DIR__ . '../../../classes/CsvManager.php';

if (!empty($_POST)) {
  if (empty($_POST['code']) == true) {
    // si aucun code n'est soumis dans le formulaire
    header('Location: /gestion-benevole/benevole/connexion/failure.php?message="code is empty');
    exit;
  } else {
    $code = $_POST['code'];


    $csv = new CsvManager('./../../csv/benevoles.csv');
    $file = $csv->openCsv();
    $benevoles = $csv->readFromCsv();


    foreach ($benevoles as $benevole) {
      $benevole_id = $benevole[0];
      // strcmp compare deux strings
      if (strcmp($benevole[0], $code) == 0) {
        $user_found = $benevole;
      }
    }

    $csv->closeCsv($file);

    if (!empty($user_found)) {
      header("Location: /gestion-benevole/benevole/index.php?code=$code");
      exit;
    } else {
      header('Location: /gestion-benevole/benevole/connexion/failure.php?message="Invalid credentials"');
      exit;
    }
  }
} else {
  // si post est empty, renvoi à la page d'erreur
  header('Location: /gestion-benevole/benevole/connexion/failure.php?message="post is empty"');
  exit;
}
