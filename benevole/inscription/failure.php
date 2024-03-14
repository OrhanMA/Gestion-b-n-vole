<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Échec de l'inscription</title>
  <link rel="stylesheet" href="./../../styles/style.css">
</head>

<body>
  <?php require_once __DIR__ . './../../composants/header.php' ?>
  <h1>Échec de l'inscription</h1>
  <p>Un problème s'est produit lors de la création de votre profil bénévole.</p>

  <div class="card index-nav">
    <?php
    if (!empty($_GET['message'] && isset($_GET['message']))) {
      $message = $_GET['message'];
      echo "<p class ='card-head'>$message</p>";
    }
    ?>
    <nav class="card-body index-nav-list">
      <a href="./index.php">Réesayer</a>
      <a href="../../index.php">Page d'accueil</a>
    </nav>
  </div>
</body>

</html>