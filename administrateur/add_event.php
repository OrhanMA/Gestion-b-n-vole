<?php

require_once __DIR__ . '/../classes/Event.php';
require_once __DIR__ . '/../classes/CsvManager.php';

$required_fields = array('region', 'titre', 'date', 'description');
$fields_empty = false;

foreach ($required_fields as $field) {
  if (empty($_POST[$field])) {
    $fields_empty = true;
    break; // exit the loop as soon as an empty field is found
  }
}

session_start();
// print_r($_SESSION);
if (!empty($_SESSION) && !empty($_SESSION['is_admin']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
  // print_r('admin ici');

  if (!empty($_POST)) {
    if (!$fields_empty) {
      $form_data = [];
      foreach ($required_fields as $field) {
        $form_data[$field] = htmlspecialchars($_POST[$field]);
      }
      // print_r($form_data);

      $event = new Event($form_data['region'], $form_data['date'], $form_data['titre'], $form_data['description']);

      print_r($event);

      $csv = new CsvManager('./../csv/events.csv');
      $file = $csv->openCsv();
      $csv->writeIntoCsv($file, ['id' => $event->id, 'region' => $event->region, 'date' => $event->date, 'titre' => $event->titre, 'description' => $event->description, 'benevoles' => '[]']);
      $csv->closeCsv($file);

      header('Location: /gestion-benevole/administrateur/index.php');
      exit;
    } else {
      header('Location: /gestion-benevole/administrateur/index.php?message=Formulaire non soumis car il manque des champs. Veuillez réesayer.');
      exit;
    }
  } else {
    header('Location: /gestion-benevole/administrateur/index.php?message=Formulaire non soumis car il manque des champs. Veuillez réesayer.');
    exit;
  }


} else {
  // n'est pas admin donc action non autorisée
  $_SESSION['is_admin'] = false;
  header('Location: /gestion-benevole/administateur/connexion/failure.php?message=Action non autorisée. Identifiez-vous afin de poursuivre.');
}
