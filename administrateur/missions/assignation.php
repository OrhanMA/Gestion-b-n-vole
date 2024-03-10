<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignation mission</title>
  <link rel="stylesheet" href="./../../styles/style.css">
</head>

<body>
  <?php require_once __DIR__ . './../../composants/header.php' ?>
  <h1>
    Quelle mission voulez-vous assigner au bénévole?
  </h1>
  <form action="./add_mission.php" method="post" class="card">
    <p class="card-head">Choisissez la mission à assigner</p>
    <div class="card-body">
      <label for="mission">
        Mission
      </label>
      <?php

      require_once __DIR__ . './../../classes/CsvManager.php';

      // print_r($_GET); 
      if (!empty($_GET) && !empty($_GET['benevole'] && isset($_GET['benevole']))) {
        $benevole = $_GET['benevole'];
        echo "<input hidden name='benevole' id='benevole' type='text' value='$benevole' readonly/>";
        // print_r('ouiii');
        $csv = new CsvManager('./../../csv/events.csv');
        $file = $csv->openCsv();
        $events = $csv->readFromCsv();
        // print_r($events);

        echo "<select required name='mission' id='mission'>";
        foreach ($events as $key => $value) {
          # code...
          echo "
          <option value=$value[0]>
          $value[3] $value[1]
          </option>";
        }
        echo "</select>";
      } else {
        // si il n'y a pas de mission
        header('Location: gestion-benevole/administrateur/missions/failure.php?message=Aucune mission assignable au bénévole');
        exit;
      }


      ?>
      <input type="submit" value="Assigner la mission" class="button-accent">
    </div>
  </form>

</body>

</html>