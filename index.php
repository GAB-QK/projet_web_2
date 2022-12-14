<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/acceuil.css" type="text/css">

  <title>Home</title>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex ">
  <img class="logo" src="https://prepeersstorage.blob.core.windows.net/academic/342_logo.png?sp=rl&st=2021-12-31T17:23:57Z&se=2022-12-31T17:23:00Z&sv=2020-08-04&sr=c&sig=SDDHph6sgvvHddvrug4O1jhZy3LU1U78BVN%2BDJjRB5M%3D" alt="Erreur">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <?php if ($_SESSION && $_SESSION["username"]) : ?>
        <a class="nav-item nav-link mx-2 mt-2 ml-2" href="./readAll.php">Actualités</a>
        <a class="nav-item nav-link active mx-2 mt-2 ml-2" href="./createPublication.php">Crée une publication</a>
        <a href="./disconnect.php" class="mx-2 mt-2 ml-2 btn btn-danger">Se déconnecter</a>
      <?php else : ?>
        <a  href="./Connexion.php" class="mx-2 mt-2 ml-2 btn btn-primary">Se connecter </a>
      <?php endif ?>
    </div>
  </div>
</nav>

<body>

  <p class="size ml3 d-flex justify-content-center">Hexa Social</p>


  <div class="d-flex justify-content-center" style="margin-left : 18px;">
    <div class="snippet" data-title=".dot-stretching">
      <div class="stage">
        <div class="dot-stretching"></div>
      </div>
    </div>
  </div>

  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="./javascript/acceuil.js"></script>

</body>


</html>