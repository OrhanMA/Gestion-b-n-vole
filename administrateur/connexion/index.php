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

  // afficher le formulaire de connexion
  // au submit: comparer les champs du formulaire avec des identifiants en dur dans le code

  // si correspondance -> redirection vers page administrateur
  // si pas de correspondance -> redirection vers la même page avec une erreur -> afficher l'erreur 

  if (!empty($_GET) && !empty($_GET['message'] && isset($_GET['message']))) {
    $message = htmlspecialchars($_GET['message']);
    echo "<p class='error'>$message</p>";
  }

  // print_r($message);
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
  <script defer>
    // pattern="/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,16}$/gm"
    // const password_input = document.getElementById('password');
    // console.log(password_input);
    // password_input.setCustomValidity("Le mot de passe doit faire entre 8 et 16 caractères et contenir au moins: 1 nombre, 1 majuscule et minuscule, 1 numéro non alphanumérique."); 
  </script>
  <style>
    .error {
      color: red;
    }
  </style>
</body>

</html>