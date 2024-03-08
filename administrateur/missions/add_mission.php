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
    $benevole_mission = $benevole[13];
    // print_r($benevole_mission);
    if (empty($benevole_mission) && isset($benevole_mission)) {
      // print_r('mission is empty');
      $benevole[13] = $mission;
      // print_r($benevole);
      $csv->update_benevole_missions($benevole_id, json_encode($benevole[13]), "./../../csv/benevoles.csv");
      header('Location: /gestion-benevole/administrateur/index.php?message=Mission associée avec succès!&success=1');
      exit;
    } else {
      print_r('mission is not empty');
      header('Location: /gestion-benevole/administrateur/missions/failure.php?message=Il y a déjà une mission associer à ce bénévole&success=0');
    }
  } else {
    echo "Benevole not found or missions field not set.";
  }
}




// function add_benevole_to_mission($benevole_id, $mission)
// {
//   $csv = new CsvManager('./../../csv/events.csv')

// }