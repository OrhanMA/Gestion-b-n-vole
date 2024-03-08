<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Échec de l'inscription</title>
</head>
<body>

  <h1>Échec de l'inscription</h1>
  <p>Un problème s'est produit lors de la création de votre profil bénévole.</p>
<?php
if (!empty($_GET['message'] && isset($_GET['message']))) {
  $message = $_GET['message'];
  echo "<p class ='error'>$message</p>";
}
?>
  <div>
    <a href="./index.php">Réesayer</a>
    <a href="../../index.php">Page d'accueil</a>
  </div>
<style>
  .error {
    color:red
  }
</style>
</body>
</html>