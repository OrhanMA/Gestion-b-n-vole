
<div>
  <h1>Erreur d'accès à l'espace adminstrateur.</h1>
  <p>Vous avez été redirigé sur cette page car une erreur s'est produite.</p>
<?php

if (!empty($_GET) && !empty($_GET['message']) && isset($_GET['message'])) {
  print_r('condition reached');
  $message = $_GET['message'];
  echo "<p style='color:red;'> $message </p>";
}

?>
  <a href="../connexion/index.php">Me reconnecter</a>
  <a href="../../index.php">Page d'accueil</a>
</div>