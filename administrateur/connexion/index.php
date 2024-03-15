<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page de connexion administrateur</title>
  <link rel="stylesheet" href="./../../styles/style.css">
</head>

<body>
  <?php require_once __DIR__ . './../../composants/header.php' ?>
  <h1>Page de connexion administrateur</h1>

  <?php
  if (isset($_GET['message']) && !empty($_GET) && !empty($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
    echo "<p class='error'>$message</p>";
  }
  ?>
  <form action="./sign_in.php" method="post" class="card">
    <p class="card-head">Entrez vos indentifiants</p>
    <div class="card-body">
      <div class="card-body-field">
        <label for="username">Nom d'utilisateur</label>
        <input required type="text" name="username" id="username" autofocus>
      </div>
      <div class="card-body-field">
        <label for="password">Mot de passe</label>
        <input required type="password" name="password" id="password">
      </div>
      <input type="submit" value="Connexion" class="button-accent">
    </div>
  </form>
</body>

</html>