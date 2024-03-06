<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion bénévole</title>
</head>
<body>
  <h1>Page de connexion bénévole</h1>
  <?php
  // mettre un form avec juste l'ID du bénévole à entrer
  // Au submit cherche avec PHP si il y a bien un bénévole
  
  // pas de bénévole -> redirection connexion error
  // bénévole -> redirection page bénévole
  ?>

  <form action="./sign_in.php" method="post">
    <div>
      <label for="code">Votre code unique:</label>
      <input type="text" name="code" id="code">
    </div>
    <input type="submit" value="Me connecter">
  </form>
  <script defer>
    const searchParams = window.location.search;
    const urlParams = new URLSearchParams(searchParams);
    const code =  urlParams.get('code');
    const input = document.querySelector('#code');
    if(input && code) input.value = code;
  </script>

</body>
</html>