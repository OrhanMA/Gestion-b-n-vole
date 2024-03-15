<?php

require_once __DIR__ . '/../../classes/Benevole.php';
require_once __DIR__ . '/../../classes/CsvManager.php';

$required_fields = array('first_name', 'last_name', 'age', 'genre', 'phone', 'email', 'region', 'dispo_jour', 'dispo_horaire', 'poste', 'message');
// check each field with regex
$regex_array = [
  '/^[a-zA-Z]{3,30}$/', '/^[a-zA-Z]{3,30}$/',
  '/^(1[89]|[2-3][0-9]|4[0-5])$/',
  '/^(homme|femme|secret)$/',
  '/^(06|07)\d{8}$/',
  '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
  '/^(Auvergne\-Rhône\-Alpes|Bourgogne\-Franche\-Comté|Bretagne|Centre\-Val de Loire|Corse|Grand Est|Hauts\-de\-France|Île\-de\-France|Normandie|Nouvelle\-Aquitaine|Occitanie|Pays de la Loire|Provence Alpes Côte d\'azure)$/',
  '/^(semaine|weekend)$/',
  '/^(matin|apres-midi|soir|nuit)$/',
  '/^(sécurité|bar|technique|animation)$/',
  '/^[a-zA-Z]{30,500}$/'
];

$is_fields_empty = is_there_empty_fields($required_fields, $_POST);

if ($is_fields_empty == true) {
  // if at least on field in $_POST is empty 
  header('Location: /gestion-benevole/benevole/inscription/failure.php?message=Un des champs est vide.');
  exit;
} else {
  $form_data = [];
  foreach ($required_fields as $field) {
    $form_data[$field] = htmlspecialchars($_POST[$field]);
  }

  $csv = new CsvManager('./../../csv/benevoles.csv');

  // Check if user already exists based on email
  $existing_user = $csv->search_in_csv(6, $form_data['email']);


  if ($existing_user) {
    // If user already exists, redirect to failure page with message
    header('Location: /gestion-benevole/benevole/inscription/failure.php?message=Il y a déjà un utilisateur avec cette adresse email.');
    exit;
  }


  $is_fields_valid = check_all_fields_validity($form_data, $regex_array);

  if (!$is_fields_valid) {
    header('Location: /gestion-benevole/benevole/inscription/failure.php?message=Un des champs a un format non valide');
    exit;
  }

  // Registration if user does not exist
  $benevole = instantiate_benevole_with_form_data($form_data);

  // Open the CSV file again to write the new user's data
  $file = $csv->openCsv();

  // print_r($file);
  $csv->writeIntoCsv($file, $benevole->get_array_from_benevole());
  $csv->closeCsv($file);

  header("Location: /gestion-benevole/benevole/inscription/success.php?code=$benevole->id");
  exit;
}



function check_all_fields_validity($form_data, $regex_array)
{
  $all_fields_valid = true;
  $index = 0;
  foreach ($form_data as $key => $value) {
    $field_valid = validate_field($form_data, $key, $regex_array[$index]);
    if ($field_valid == false) {
      $all_fields_valid = false;
      break;
    }
    $index++;
  }
  return $all_fields_valid;
}

function validate_field($form_data, $field, $regex = null)
{
  if ($regex == null) {
    return "pas de regex possibles pour comparer le champ";
  } else {
    $value = $form_data[$field];
    // perform a match with a regex, return true if there is match (field valid) and false is field does not respect the regex
    return preg_match($regex, $value);
  }
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


function instantiate_benevole_with_form_data($form_data)
{
  return new Benevole($form_data['first_name'], $form_data['last_name'], $form_data['age'], $form_data['genre'], $form_data['phone'], $form_data['email'], $form_data['region'], $form_data['dispo_jour'], $form_data['dispo_horaire'], $form_data['poste'], $form_data['message']);
}
