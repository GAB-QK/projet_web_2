<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/acceuil.css" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <title>ReadAll</title>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img class="logo" src="https://prepeersstorage.blob.core.windows.net/academic/342_logo.png?sp=rl&st=2021-12-31T17:23:57Z&se=2022-12-31T17:23:00Z&sv=2020-08-04&sr=c&sig=SDDHph6sgvvHddvrug4O1jhZy3LU1U78BVN%2BDJjRB5M%3D" alt="Erreur">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="./index.php">Home </a>
            <a class="nav-item nav-link active" href="./readAll.php">Actualités</a>
            <a class="nav-item nav-link" href="./createPublication.php">Crée une publication</a>
            <?php if ($_SESSION && $_SESSION["username"]) : ?>
                <a href="./disconnect.php" class="mx-2 btn btn-danger">Se déconnecter</a>
                <? echo $_SESSION["username"]?>
            <?php endif ?>
        </div>
    </div>
</nav>

<body>

    <?php
    function loadClass($class)
    {
        if (str_contains($class, "Manager")) {
            require "./controllers/$class.php";
        } else {
            require "./models/$class.php";
        }
    }
    spl_autoload_register("loadClass");
    $manager = new ArticleManager();
    $articles = $manager->getAll();

    require "./controllers/UserController.php";
    $userController = new UserController();
    $users = $userController->readAll();


    ?>
    <?php
    if ($_SESSION && $_SESSION["username"]) :
    ?>
        <div class="d-flex flex-wrap justify-content-center">
            <?php
            foreach ($articles as $article) {
            ?>
                <div class="card w-75 mt-5">
                    <div class="card-header">
                        <p>de <?= $article->getAuthor(); ?>,</p>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $article->getTitle(); ?></h5>
                        <p class="card-text"><?= $article->getContent(); ?></p>
                        <p class="card-text text-muted "><?= $article->getCreated_at(); ?></p>
                        <div class="btn-group w-25" role="group" aria-label="Basic mixed styles example">
                            <?if ($_SESSION["id"] == $article->getId_user()) :?>
                                <a class="btn btn-danger" onclick="deleteArticle('<?= $article->getId() ?>')">
                                    <img src="./images/cross.png" alt="cross" class="w-25" />
                                </a>
                                <a href="./update.php?id=<?= $article->getId() ?>" class="btn btn-warning ">
                                    <img src="./images/pen.png" alt="pen" class="w-25" />
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
        <script>
            function deleteArticle(id) {
                if (confirm("confirmer la suppression")) {
                    window.location.href = "./delete.php?id=" + id
                }
            }
        </script>

        <script src="./javascript/acceuil.js"></script>
    <?php else : ?>
        <h3>Vous devez vous <a href="./Connexion.php">connecter</a> !</h3>
    <?php endif ?>
</body>

</html>