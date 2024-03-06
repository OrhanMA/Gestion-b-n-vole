<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page de bénévole</title>
</head>
<body>
  <h1>Page bénévole</h1>
  <p>
    Page de détail pour le bénévole ID#
    <span class="id-benevole"></span>
  </p>
  
  <?php

  require_once __DIR__ . './../classes/CsvManager.php';
  // print_r($_GET);
  
  if (!empty($_GET)) {
    if (!empty($_GET['code']) && isset($_GET['code'])) {
      // si $_GET n'est pas vide et $_GET['code'] est différent de null et pas vide:
      $code = $_GET['code'];

      $csv = new CsvManager('./../csv/benevoles.csv');
      $user_found = $csv->getBenevoleByID($code, './../csv/benevoles.csv');

      if (isset($user_found) && !empty($user_found)) {
        // print_r($user_found);
  

        // nom, prénom, autres infos
        // date inscription 
        // préférences dispos...
        echo "
        <div class='benevole_categories'>
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
            <p> Votre message personnalié </p>
            <ul>
              <li> $user_found[11] </li>
            </ul>
          </div>
        </div>";
      }

    }
  }

  // récupérer l'ID du user passé en paramètre d'url. Cet ID est passé dans le location header côté back-end
  
  // récupérer ses données avec php avec l'id au chargement de la page
  
  // les afficher
  
  // proposer une redirection vers la page d'accueil et vers logout? 
  ?>
    <script defer>
    const searchParams = window.location.search;
    const urlParams = new URLSearchParams(searchParams);
    const code =  urlParams.get('code');
    const benevole_span =document.querySelector('.id-benevole');
    if(code && benevole_span)benevole_span.textContent = code;

  </script>
</body>
</html>