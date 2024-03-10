<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion bénévole</title>
  <link rel="stylesheet" href="./../../styles/style.css">
</head>

<body>
  <h1>Page de connexion bénévole</h1>
  <form action="./sign_in.php" method="post" class="card">
    <p class="card-head">
      Connexion
    </p>
    <div class="card-body">
      <label for="code">Votre code unique:</label>
      <input type="text" name="code" id="code">
      <input type="submit" value="Me connecter" class="button-accent">
    </div>
  </form>
  <script defer>
    const searchParams = window.location.search;
    const urlParams = new URLSearchParams(searchParams);
    const code = urlParams.get('code');
    const input = document.querySelector('#code');
    if (input && code) input.value = code;
  </script>

</body>

</html>