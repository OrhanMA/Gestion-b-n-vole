<?php

require_once __DIR__ . '../../../classes/CsvManager.php';

// print_r($_POST);

if (!empty($_POST)) {
  if (empty($_POST['code']) == true) {
    header('Location: /gestion-benevole/benevole/connexion/failure.php');
    exit;
  } else {
    $code = $_POST['code'];
    $csv = new CsvManager('./../../csv/benevoles.csv');
    $file = $csv->openCsv();
    $csv->readCsv();
    $benevoles = $csv->readFromCsv();

    foreach ($benevoles as $benevole) {
      if ($benevole[0] == $code) {
        print_r('user found');
        print_r($benevole);

        header("Location: /gestion-benevole/benevole/index.php?code=$code");
        exit;
      } else {
        print_r('no user found');
        header('Location: /gestion-benevole/benevole/connexion/failure.php');
        exit;
      }
    }

    $csv->closeCsv($file);
    exit;
  }
} else {
  header('Location: /gestion-benevole/benevole/connexion/failure.php');
  exit;
}

