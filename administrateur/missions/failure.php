<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Échec ajout de la mission</title>
  <link rel="stylesheet" href="./../../styles/style.css">
</head>

<body>
  <div>
    <h1>
      <?php
      if (!empty($_GET['message']) && isset($_GET['message'])) {
        echo $_GET['message'];
      } else {
        echo "Un problème est survenu lors de l'ajout de la mission";
      } ?></h1>
    <div class="card">
      <p class="card-head">Redirections</p>
      <div class="card-body index-nav-list">
        <a href="./../index.php">retourner sur la page administrateur</a>
        <a href="./../../index.php">retourner sur la page d'accueil</a>
      </div>
    </div>
  </div>
</body>

</html>