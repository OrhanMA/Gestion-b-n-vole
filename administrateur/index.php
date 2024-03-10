<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page administrateur</title>
  <link rel="stylesheet" href="./../styles/style.css">
</head>

<body>
  <?php

  session_start();



  if (!empty($_SESSION)) {
    if (!empty($_SESSION['is_admin']) && isset($_SESSION['is_admin'])) {
      $is_admin = $_SESSION['is_admin'] == 1 ? true : false;
      // print_r($is_admin);
      if ($is_admin != 1) {
        // print_r('le gars est pas admin');
        // session_destroy();
        header('Location: gestion-benevole/administrateur/connexion/index.php?message=Veuillez vous identifier pour accéder à la page administrateur');
        exit;
      } else {
        // print_r('le gars est admin');
      }
    } else {
      // print_r('session is empty or null');
      header('Location: gestion-benevole/administrateur/connexion/index.php?message=Veuillez vous identifier pour accéder à la page administrateur');
    }
  } else {
    print_r('session is empty');
    // session_destroy();
    header('Location: gestion-benevole/administrateur/connexion/index.php?message=Veuillez vous identifier pour accéder à la page administrateur');
    exit;
  }
  ?>
  <h1>Page administrateur</h1>
  <span style="color: <?php echo isset($_GET['success']) && $_GET['success'] == "1" ? 'green' : 'red'; ?>;">
    <?php
    if (!empty($_GET['message'])) {
      $message = $_GET['message'];
      echo htmlspecialchars($message);
    }
    ?>
  </span>
  <div class="content-container">
    <div class="card">
      <p class="card-head">Liste des bénévoles</p>
      <ul class="admin-benevole-list card-body">
        <?php

        require_once __DIR__ . './../classes/CsvManager.php';

        $csv = new CsvManager('./../csv/benevoles.csv');
        $file = $csv->openCsv();
        $benevoles = $csv->readFromCsv();
        // print_r($benevoles);
        foreach ($benevoles as $key => $value) {
          # code...
          echo "
          <li>
            <div>
              <p>$value[1]</p>
              <p>$value[2]</p>
            </div>
            <a href='http://localhost:8888/gestion-benevole/administrateur/missions/assignation.php?benevole=$value[0]'>Assigner une mission</a>
          </li>";
        }



        ?>
      </ul>
    </div>

    <div class="card">
      <p class="card-head">Liste des évènements</p>
      <?php

      require_once __DIR__ . './../classes/CsvManager.php';

      $csv = new CsvManager('./../csv/events.csv');
      $file = $csv->openCsv();
      $events = $csv->readFromCsv();

      // print_r($events);
      echo "<ul class='admin-event-list card-body'>";
      foreach ($events as $event) {
        # code...
        // print_r($event);
        echo "
      <li class='card-body'>
        <p>Titre: $event[3]</p>
        <p>Région: $event[1]</p>
        <p>Date: $event[2]</p>
        <p>Description: </br> $event[4]</p>
      </li>
      ";
      }
      echo "</ul>";

      ?>
    </div>
  </div>
  <form action="./add_event.php" method="post" class="card">

    <p class="card-head">Remplissez ce formulaire pour ajouter un évènement</p>
    <div class="card-body">

      <div class="form_field_container">
        <label for="titre">Titre</label>
        <input required minlength="3" maxlength="50" type="text" name="titre" id="titre">
      </div>
      <div class="form_field_container">
        <label for="region">Région</label>
        <select required name="region" id="region">
          <option value="Auvergne-Rhône-Alpes">Auvergne-Rhône-Alpes</option>
          <option value="Bourgogne-Franche-Comté">Bourgogne-Franche-Comté</option>
          <option value="Bretagne">Bretagne</option>
          <option value="Centre-Val-de-loire">Centre-Val de Loire</option>
          <option value="Corse">Corse</option>
          <option value="Grand-Est">Grand Est</option>
          <option value="Hauts-de-France">Hauts-de-France</option>
          <option value="Île-de-France">Île-de-France</option>
          <option value="Normandie">Normandie</option>
          <option value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
          <option value="Occitanie">Occitanie</option>
          <option value="Pays-de-la-loire">Pays de la Loire</option>
          <option value="Provence-Alpes-Côte-d-azure">Provence Alpes Côte d'azure</option>
        </select>
      </div>
      <div class="form_field_container">
        <label for="date">Date</label>
        <input required type="date" name="date" id="date" value="<?php $date = date('Y-m-d');
                                                                  echo "$date"; ?>" min="<?php
                                                                                          $date = date('Y-m-d');
                                                                                          echo "$date"; ?>">
      </div>
      <div class="form_field_container">
        <label for="description">Description</label>
        <textarea required minlength="5" maxlength="100" name="description" id="description" cols="30" rows="10"></textarea>
      </div>
      <input type="submit" value="Ajouter l'évènement" class="button-accent">
    </div>
  </form>

</body>

</html>