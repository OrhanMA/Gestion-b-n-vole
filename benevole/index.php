<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page de bénévole</title>
  <link rel="stylesheet" href="./../styles/style.css">
</head>

<body>
  <?php require_once __DIR__ . './../composants/header.php' ?>
  <h1>Page bénévole</h1>

  <?php
  require_once __DIR__ . './../classes/CsvManager.php';

  if (isset($_GET) && !empty($_GET)) {
    if (isset($_GET['code']) && !empty($_GET['code'])) {
      // si $_GET n'est pas vide et $_GET['code'] est différent de null et pas vide:
      $code = $_GET['code'];

      $csv = new CsvManager('./../csv/benevoles.csv');
      $user_found = $csv->getBenevoleByID($code, './../csv/benevoles.csv');

      if (isset($user_found) && !empty($user_found)) {
        display_benevole_data($user_found);
        $mission_id = json_decode($user_found[13]);

        if (isset($mission_id) && !empty($mission_id)) {
          $event_csv = new CsvManager('./../csv/events.csv');
          $file = $event_csv->readCsv();
          $mission = $event_csv->getEventByID($mission_id, './../csv/events.csv');
          display_mission_data($mission);
        }
      }
    }
  } else {
    header('Location: ./connexion/index.php');
  }

  function display_benevole_data($user_found)
  {
    echo "
    <div class='benevole_categories card'>
      <p class='card-head'>
    Page de détail pour le bénévole ID#
    <span class='id-benevole'></span>
      </p>
      <div class='card-body'>
        <div class='benevole_categorie_container'>
          <p> Préférences </p>
          <ul>
            <li>Prénom: $user_found[1]</li>  
            <li>Nom: $user_found[2]</li>  
            <li>Âge: $user_found[3]</li>  
            <li>Sexe: $user_found[4]</li>  
            <li>Téléphone: $user_found[5]</li>  
            <li>Email: $user_found[6]</li>  
            <li>Inscrit(e) depuis le: $user_found[12]</li>  
          </ul>
        </div>
        <div class='benevole_categorie_container'>
          <p> Région </p>
          <ul>
            <li>Région: $user_found[7]</li>  
            <li>Disponibilité (jour): $user_found[8]</li>  
            <li>Disponibilité (horaire): $user_found[9]</li>  
          </ul>
        </div>
        <div class='benevole_categorie_container'>
          <p> Préférence de poste </p>
          <ul>
            <li> $user_found[10] </li>
          </ul>
        </div>
        <div class='benevole_categorie_container'>
          <p> Votre message personnalisé </p>
          <div  class='benevole-message'>
          <p> $user_found[11] </p>
          </div>
        </div>
      </div>
    </div>";
  }

  function display_mission_data($mission)
  {
    echo "<div class='card mission-card'>";
    echo "<p class='card-head'>Mission(s) attitrée(s)</p>";
    echo "<ul>";
    echo
    "
    <li>
    <p>Titre: $mission[3]</p>
    <p>Région: $mission[1]</p>
    <p>Date: $mission[2]</p>
    <p class='mission-card-description'>Description: $mission[4]</p>
    
    </li>
    ";
    echo "</ul>";
    echo "</div>";
  }
  ?>
  <script defer>
    const searchParams = window.location.search;
    const urlParams = new URLSearchParams(searchParams);
    const code = urlParams.get('code');
    const benevole_span = document.querySelector('.id-benevole');
    if (code && benevole_span) benevole_span.textContent = code;
  </script>
</body>

</html>