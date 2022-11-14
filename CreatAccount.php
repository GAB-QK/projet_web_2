<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/acceuil.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Creat account</title>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-start ml-3 ">
  <a href="javascript:;" onclick="history.back()" class="nav-item nav-link active"><i class="fa-sharp fa-solid fa-arrow-left"></i></a>
</nav>

<body>

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
    $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $user = new User($_POST);
    $userController->create($user);
    $_SESSION["username"] = $user->getUsername();
    $_SESSION["email"] = $user->getEmail();
    $_SESSION["lastname"] = $user->getLastName();
    $_SESSION["firstname"] = $user->getFirstName();
    echo "<script>window.location.href = './Connexion.php'</script>";
  }

  ?>


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
                <img src="./images/cartoon.webp" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form method="POST">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <span class="h1 fw-bold mb-0"> Crée ton compte ! </span>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" id="username" class="form-control form-control-lg" name="username" />
                      <label class="form-label" for="username">Pseudo</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" id="firstname" class="form-control form-control-lg" name="firstname" />
                      <label class="form-label" for="firstname">Prénom</label>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="text" id="lastname" class="form-control form-control-lg" name="lastname" />
                      <label class="form-label" for="lastname">Nom</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="email" id="email" class="form-control form-control-lg" name="email" />
                      <label class="form-label" for="email">Adresse mail</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="password" class="form-control form-control-lg" name="password" />
                      <label class="form-label" for="password">Mot de passe</label>
                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">Enregistrer</button>
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