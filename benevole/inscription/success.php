<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmation de l'inscription</title>
  <link rel="stylesheet" href="./../../styles/style.css">
</head>

<body>
  <?php require_once __DIR__ . './../../composants/header.php' ?>
  <h1>Confirmation de l'inscription</h1>
  <p>Vous avez bien été inscrit votre code est: <span style="font-weight: bold;"></span>.</p>
  <p> Notez le bien!</p>

  <div class="card index-nav">
    <p class="card-head">Redirections</p>
    <nav class="index-nav-list card-body">

      <a href="../../benevole/connexion/index.php" class="connexion_anchor">Accéder à mon espace</a>
      <a href="../../index.php">Page d'accueil</a>
    </nav>
  </div>
  <script defer>
    const searchParams = window.location.search;
    const urlParams = new URLSearchParams(searchParams);
    const code = urlParams.get('code');
    const codePlaceholder = document.querySelector('span');
    codePlaceholder.textContent = code;
    const connexion_anchor = document.querySelector('.connexion_anchor');
    connexion_anchor.href = '../../benevole/connexion/index.php' + `?code=${code}`;
  </script>
</body>

</html>