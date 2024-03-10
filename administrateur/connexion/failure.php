<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Erreur connexion Administrateur</title>
  <link rel="stylesheet" href="./../../styles/style.css">
</head>

<body>
  <h1>Erreur d'accès à l'espace adminstrateur.</h1>
  <div class="card">
    <div class="card-body">

      <p class="card-head">Vous avez été redirigé sur cette page car une erreur s'est produite.</p>
      <?php

      if (!empty($_GET) && !empty($_GET['message']) && isset($_GET['message'])) {
        print_r('condition reached');
        $message = $_GET['message'];
        echo "<p style='color:red;'> $message </p>";
      }

      ?>
      <div class="index-nav-list" style="display: flex;">
        <a href="../connexion/index.php">Me reconnecter</a>
        <a href="../../index.php">Page d'accueil</a>
      </div>
    </div>
  </div>

</body>

</html>