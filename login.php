<?php
    session_start();
    require 'database.php';
    if (!empty($_POST)){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $message = '';
        print_r($results);
        if (count($results)>0 and password_verify($_POST['password'], $results['password'])) {
          $_SESSION['user_id'] = $results['id'];
          header('location:dashboard.php');
        }else{
          $message = 'Tu usuario o contraseña no son correctos.';
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Login | SavingTheAmazon</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <?php if(!empty($message)): ?>
    <p><?= $message ?></p>
  <?php endif; ?>
  <form action="login.php" method="POST">
    <a href="index.php" ><img class="mb-4" src="assets/img/logo.png" alt="" width="82" height="67"></a>
   
    <label for="inputEmail" class="visually-hidden">Correo Electrónico</label>
    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Correo Electronico" required autofocus>
    <label for="inputPassword" class="visually-hidden">Contraseña</label>
    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
    <div>
      <a href="signup.php">o Registrarme</a>
    </div>
    <br/>
    <button class="w-100 btn btn-lg btn-success" type="submit">Ingresa</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2021</p>
  </form>
</main>
    
  </body>
</html>
