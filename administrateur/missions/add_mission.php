<?php

require_once __DIR__ . './../../classes/CsvManager.php';

if (isset($_POST['mission']) && isset($_POST['benevole']) && !empty($_POST) && !empty($_POST['mission']) && !empty($_POST['benevole'])) {
  $mission = htmlspecialchars($_POST['mission']);
  $benevole_id = htmlspecialchars($_POST['benevole']);
  add_mission_to_benevole($mission, $benevole_id);
} else {
  header('Location: gestion-benevole/administrateur/missions/failure.php?message=Données insuffisantes pour assigner la mission');
  exit;
}

function add_mission_to_benevole($mission, $benevole_id)
{
  $csv = new CsvManager('./../../csv/benevoles.csv');
  $benevole = $csv->getBenevoleByID($benevole_id, './../../csv/benevoles.csv');

  if (isset($benevole[13]) && !empty($benevole)) {
    $benevole_mission = $benevole[13];
    if (isset($benevole_mission) && empty($benevole_mission)) {
      $benevole[13] = $mission;
      $csv->update_benevole_missions($benevole_id, json_encode($benevole[13]), "./../../csv/benevoles.csv");
      header('Location: /gestion-benevole/administrateur/index.php?message=Mission associée avec succès!&success=1');
      exit;
    } else {
      header('Location: /gestion-benevole/administrateur/missions/failure.php?message=Il y a déjà une mission associer à ce bénévole&success=0');
    }
  } else {
    echo "Benevole not found or missions field not set.";
  }
}
