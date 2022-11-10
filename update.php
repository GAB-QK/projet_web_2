<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/acceuil.css" type="text/css">
    <title>modification d'articles</title>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img class="logo" src="https://prepeersstorage.blob.core.windows.net/academic/342_logo.png?sp=rl&st=2021-12-31T17:23:57Z&se=2022-12-31T17:23:00Z&sv=2020-08-04&sr=c&sig=SDDHph6sgvvHddvrug4O1jhZy3LU1U78BVN%2BDJjRB5M%3D" alt="Erreur">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="./index.php">Home </a>
            <a class="nav-item nav-link " href="./readAll.php">Actualités</a>
            <a class="nav-item nav-link active" href="#">modifier publication</a>
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

        $manager = new ArticleManager();

        if ($_GET) {
            $article = $manager->get($_GET['id']);
        }

        if ($_POST) {

            $donnees = [
                "id" => $_GET["id"],
                "content" => $_POST["content"],
                "author" => $_POST["author"],
                "title" => $_POST["title"],
                "lien_image" => $_POST["lien_image"]
            ];

            $manager->update(new Article($donnees));
            echo "<script> window.location.href='readAll.php'</script>";
            exit();
        } ?>
        <div>
            <div>
                <p class="display-1 d-flex justify-content-center text-white mt-1"> Modifie ta publication !</p>
            </div>
            <form method="POST" class="container mt-2">
                <label>Auteur</label>
                <input type="text" name="author" id="author" class="form-control mb-3" placeholder="Auteur de l'article" value="<?= $article->getAuthor(); ?>">
                <label>Titre</label>
                <input type="text" name="title" id="title" class="form-control mb-3" placeholder="titre de l'article" value="<?= $article->getTitle(); ?>">
                <label>Contenu</label>
                <textarea name="content" id="content" class="form-control mb-3" placeholder="Le contenu de l'article"><?= $article->getContent(); ?></textarea>
                <label>URL de l'image</label>
                <input type="url" name="lien_image" id="lien_image" class="form-control" placeholder="lien de l'image" value="<?= $article->getLien_image(); ?>">
                <input type="submit" value="Modifier ! " class=" mt-3 btn btn-primary">
            </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
        <script src="./javascript/acceuil.js"></script>
        <script src="./javascript/nav.js"></script>
    <?php else : ?>
        <h3>Vous devez vous <a href="./Connexion.php">connecter</a> !</h3>
    <?php endif ?>
    </body>

</html>