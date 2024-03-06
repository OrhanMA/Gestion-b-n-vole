<?php

require_once __DIR__ . '/../../classes/Benevole.php';
require_once __DIR__ . '/../../classes/CsvManager.php';

$required_fields = array('first_name', 'last_name', 'age', 'genre', 'phone', 'email', 'region', 'dispo_jour', 'dispo_horaire', 'poste', 'message');
$fields_empty = false;

foreach ($required_fields as $field) {
  if (empty($_POST[$field])) {
    $fields_empty = true;
    break; // exit the loop as soon as an empty field is found
  }
}


if ($fields_empty) {
  // if at least on field in $_POST is empty 
  header('Location: /gestion-benevole/benevole/inscription/failure.php');
  exit;
} else {
  $form_data = [];
  foreach ($required_fields as $field) {
    $form_data[$field] = htmlspecialchars($_POST[$field]);
  }
  // print_r($form_data);
  $benevole = new Benevole($form_data['first_name'], $form_data['last_name'], $form_data['age'], $form_data['genre'], $form_data['phone'], $form_data['email'], $form_data['region'], $form_data['dispo_jour'], $form_data['dispo_horaire'], $form_data['poste'], $form_data['message']);


  $csv = new CsvManager('./../../csv/benevoles.csv');


  $file = $csv->openCsv();
  $csv->writeIntoCsv($file, ['id' => $benevole->id, 'first_name' => $benevole->first_name, 'last_name' => $benevole->last_name, 'age' => $benevole->age, 'genre' => $benevole->genre, 'phone' => $benevole->phone, 'email' => $benevole->email, 'region' => $benevole->region, 'dispo_jour' => $benevole->dispo_jour, 'dispo_horaire' => $benevole->dispo_horaire, 'poste' => $benevole->poste, 'message' => $benevole->message, 'date_inscription' => $benevole->date_inscription]);
  $csv->closeCsv($file);

  header("Location: /gestion-benevole/benevole/inscription/success.php?code=$benevole->id");
  exit();
}
