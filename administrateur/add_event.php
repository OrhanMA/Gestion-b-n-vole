<?php

require_once __DIR__ . '/../classes/Event.php';
require_once __DIR__ . '/../classes/CsvManager.php';

$required_fields = array('region', 'titre', 'date', 'description');
$fields_empty = is_there_empty_fields($required_fields);

session_start();
if (isset($_SESSION['is_admin']) && !empty($_SESSION) && !empty($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
  if (!empty($_POST)) {
    if (!$fields_empty) {
      $form_data = [];
      foreach ($required_fields as $field) {
        $form_data[$field] = htmlspecialchars($_POST[$field]);
      }

      $date = DateTime::createFromFormat('Y-m-d', $form_data['date']);
      $formatted_date = $date->format('d-m-Y');
      $form_data['date'] = $formatted_date;

      $event = new Event($form_data['region'], $form_data['date'], $form_data['titre'], $form_data['description']);
      $csv = new CsvManager('./../csv/events.csv');
      $file = $csv->openCsv();
      $csv->writeIntoCsv($file, $event->get_array_from_event());
      $csv->closeCsv($file);

      header('Location: /gestion-benevole/administrateur/index.php?message=Évènement bien enregistré&success=1');
      exit;
    } else {
      header('Location: /gestion-benevole/administrateur/index.php?message=Formulaire non soumis car il manque des champs. Veuillez réesayer.&success=0');
      exit;
    }
  } else {
    header('Location: /gestion-benevole/administrateur/index.php?message=Formulaire non soumis car il manque des champs. Veuillez réesayer.&success=0');
    exit;
  }
} else {
  // n'est pas admin donc action non autorisée
  $_SESSION['is_admin'] = false;
  header('Location: /gestion-benevole/administateur/connexion/failure.php?message=Action non autorisée. Identifiez-vous afin de poursuivre.&success=0');
}



function is_there_empty_fields($required_fields)
{
  $fields_empty = false;
  foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
      $fields_empty = true;
      break; // exit if field empty
    }
  }
  return $fields_empty;
}
