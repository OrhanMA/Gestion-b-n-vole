<?php

require_once __DIR__ . './../../classes/CsvManager.php';

// print_r($_POST);

if (!empty($_POST) && !empty($_POST['mission']) && isset($_POST['mission']) && !empty($_POST['benevole']) && isset($_POST['benevole'])) {

  // print_r('on a tout');
  $mission = htmlspecialchars($_POST['mission']);
  $benevole_id = htmlspecialchars($_POST['benevole']);

  add_mission_to_benevole($mission, $benevole_id);
  // add_benevole_to_mission($benevole_id, $mission);

} else {
  header('Location: gestion-benevole/administrateur/missions/failure.php?message=Données insuffisantes pour assigner la mission');
  exit;
}


function add_mission_to_benevole($mission, $benevole_id)
{
  $csv = new CsvManager('./../../csv/benevoles.csv');
  $benevole = $csv->getBenevoleByID($benevole_id, './../../csv/benevoles.csv');

  if (!empty($benevole) && isset($benevole[13])) {
    $benevole_missions = json_decode($benevole[13], true);

    // Check if decoding was successful
    if ($benevole_missions !== null) {
      // Add mission to the array
      $benevole_missions[] = $mission;

      // Encode the updated missions array back to JSON
      $updated_missions_json = json_encode($benevole_missions);

      // print_r($updated_missions_json);
      // Update the CSV with the updated missions array

      $csv->update_benevole_missions($benevole_id, $updated_missions_json, './../../csv/benevoles.csv');

      // Now $benevole_missions contains the updated array with the new mission added
      // print_r($benevole_missions);
    } else {
      echo "Error decoding JSON string.";
    }
  } else {
    echo "Benevole not found or missions field not set.";
  }
}




// function add_benevole_to_mission($benevole_id, $mission)
// {
//   $csv = new CsvManager('./../../csv/events.csv')

// }