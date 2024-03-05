<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmation de l'inscription</title>
</head>
<body>
  <h1>Confirmation de l'inscription</h1>
  <?php

  // envoyer dans les paramètres d'url l'id du nouvel utilisateur
  // récupérer l'ID du user passé en paramètre d'url
  // afficher l'ID pour que l'utilisateur puisse le noter
  // proposer une redirection vers la page connexion bénévole ou page d'accueil
  
  ?>

  <p>Vous avez bien été inscrit votre code est: <span style="font-weight: bold;"></span>. Notez le bien!</p>

  <div>
    <a href="../../benevole/connexion/index.php" class="connexion_anchor" >Accéder à mon espace</a>
    <a href="../../index.php">Page d'accueil</a>
  </div>
  <script defer>
    const searchParams = window.location.search;
    const urlParams = new URLSearchParams(searchParams);
    const code =  urlParams.get('code');
    const codePlaceholder = document.querySelector('span');
    codePlaceholder.textContent = code;
    const connexion_anchor =document.querySelector('.connexion_anchor');
    connexion_anchor.href = '../../benevole/connexion/index.php' + `?code=${code}`;

  </script>
</body>
</html>