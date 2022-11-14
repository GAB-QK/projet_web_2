<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/acceuil.css" type="text/css">
    <title>création d'articles</title>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <img class="logo" src="https://prepeersstorage.blob.core.windows.net/academic/342_logo.png?sp=rl&st=2021-12-31T17:23:57Z&se=2022-12-31T17:23:00Z&sv=2020-08-04&sr=c&sig=SDDHph6sgvvHddvrug4O1jhZy3LU1U78BVN%2BDJjRB5M%3D" alt="Erreur">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link mx-2 mt-2 ml-2" href="./index.php">Home </a>
            <a class="nav-item nav-link mx-2 mt-2 ml-2" href="./readAll.php">Actualités</a>
            <a class="nav-item nav-link active mx-2 mt-2 ml-2" href="./createPublication.php">Crée une publication</a>
            <?php if ($_SESSION && $_SESSION["username"]) : ?>
                <p class="nav-link text-black mx-2 mt-2 ml-2">
                    compte de : <? echo $_SESSION["username"] ?>
                </p>
                <a href="./disconnect.php" class="nav-item m-2 btn btn-danger">Se déconnecter</a>
            <?php endif ?>
        </div>
    </div>
</nav>
<?php
if ($_SESSION && $_SESSION["username"]) :
?>

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
        require "./controllers/UserController.php";
        $userController = new UserController();
        $users = $userController->readAll();




        if ($_POST) {
            $manager = new ArticleManager();
            $newArticle = new Article($_POST);
            $newArticle->setId_user($_SESSION["id"]);
            $manager->add($newArticle);
            $id = $manager->getLast()->getId();
            echo "<script> window.location.href='readAll.php'</script>";
            exit();
        }
        ?>
        <div>
            <div>
                <p class="display-1 d-flex justify-content-center text-white mt-1"> Nouvelle publication !</p>
            </div>
            <form method="POST" class="container mt-2">
                <input type="hidden" name="author" id="author" class="form-control mb-3" placeholder="Auteur de l'article" value="<?= $_SESSION["username"] ?>">
                <label>Titre</label>
                <input type="text" name="title" id="title" class="form-control mb-3" placeholder="titre de l'article">
                <label>Contenu</label>
                <textarea name="content" id="content" class="form-control mb-3" placeholder="Le contenu de l'article"></textarea>
                <input type="submit" value="Publier" class=" mt-3 btn btn-primary">
            </form>
        </div>

    </body>
<?php else : ?>
    <h3>Vous devez vous <a href="./Connexion.php">connecter</a> !</h3>
<?php endif ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="./javascript/acceuil.js"></script>

</html>