<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/acceuil.css" type="text/css">

  <title>Connexion</title>
</head>

<?php

function loadClass($class)
{
  if (str_contains($class, "Controller")) {
    require "./controllers/$class.php";
  } else {
    require "./models/$class.php";
  }
}
spl_autoload_register("loadClass");

$userController = new UserController();

if ($_POST) {
  $valid_account = 0;
  $users = $userController->readAll();
  foreach ($users as $user) {
    if ($_POST["username"] == $user->getUsername() && password_verify($_POST["password"], $user->getPassword())) {
      $_SESSION["username"] = $user->getUsername();
      $_SESSION["email"] = $user->getEmail();
      $_SESSION["id"] = $user->getId();
      $valid_account = 1;
      echo "<script>window.location.href = './readAll.php'</script>";
    }
    //echo ("<script>alert('vos identifiant sont incorect') </script> ") ; // erreur sur execution du else avec alert à revoir fonctionne avec 
    //echo "<script>window.location.href = './Connexion.php'</script>";    // un eco lambda pourtant 
  }
  if ($valid_account == 0) {
    echo "faux creds";
  }
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light ">
  <img class="logo" src="https://prepeersstorage.blob.core.windows.net/academic/342_logo.png?sp=rl&st=2021-12-31T17:23:57Z&se=2022-12-31T17:23:00Z&sv=2020-08-04&sr=c&sig=SDDHph6sgvvHddvrug4O1jhZy3LU1U78BVN%2BDJjRB5M%3D" alt="Erreur">
  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon "></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav mx-2 mt-2 ml-2">
      <a class="nav-item nav-link active" href="./index.php">Home </a>
    </div>
  </div>

</nav>

<body>

  <h1 class="ml3 d-flex justify-content-center">Hexa Social</h1>

  <div class="d-flex justify-content-center" style="margin-left : 18px;">
    <div class="snippet" data-title=".dot-stretching">
      <div class="stage">
        <div class="dot-stretching"></div>
      </div>
    </div>
  </div>

  <section>
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="./images/cartoon.webp" alt="login form" class="img-fluid" style="border-radius: 1rem 0 1rem 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form method="POST">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0 "> Connecte toi ! </span>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" id="username" class="form-control form-control-lg" name="username" />
                      <label class="form-label" for="username">Pseudo</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="password" class="form-control form-control-lg" name="password" />
                      <label class="form-label" for="password">Mot de passe</label>
                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">connexion</button>
                    </div>
                    <div class="pt-1 mb-4">
                      <a href="./CreatAccount.php">
                        <button class="btn btn-primary btn-lg btn-block" type="button">Creat account</button>
                      </a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="./javascript/acceuil.js"></script>

</body>


</html>