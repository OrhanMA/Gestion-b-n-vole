<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page  administrateur</title>
  <link rel="stylesheet" href="../styles/style.css">
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
      print_r('le gars est admin');
    }
  } else {
    print_r('session is empty or null');
    header('Location: gestion-benevole/administrateur/connexion/index.php?message=Veuillez vous identifier pour accéder à la page administrateur');
  }
} else {
  print_r('session is empty');
  // session_destroy();
  header('Location: gestion-benevole/administrateur/connexion/index.php?message=Veuillez vous identifier pour accéder à la page administrateur');
  exit;
}
// afficher un formulaire pour créer un évènement ✅

// récupérer avec php la liste de tous les bénévoles

// mettre un champ à sélection multiple et y injecter les propositions de bénévoles

// mettre des contraintes de champs avec javascript 
// à la soumission du formulaire:
// récupérer les données du formulaire dans un autre fichier ✅
// valider les données ✅
// créer une nouvelle instance d'évènements ✅
// pour les bénévoles, les ajouter à la propriété d'Évènements dans un tableau pour les réunir. 
// enregister l'évènement dans le CSV ✅
// rediriger vers la même page qui mettra automatiquement à jour les données grâce au script déjà écrit. ✅


?>
  <h1>Page administrateur</h1>
  <div class="content-container">
    <div>
      <p>Liste des bénévoles</p>
      <ul class="admin-benevole-list">
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
  
    <form action="./add_event.php" method="post">
      <span style="color:red; font-weight:bold;">
        <?php
        if (!empty($_GET['message']) && isset($_GET['message'])) {
          $message = $_GET['message'];
          echo "$message";
        }
        ?>
      </span>
      <caption>Remplissez ce formulaire pour ajouter un évènement</caption>
      <div class="form_field_container">
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre">
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
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
      </div>
      <input type="submit" value="Ajouter l'évènement">
    </form>
  </div>
</body>
</html>