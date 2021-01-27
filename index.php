<?php
    session_start();
    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $query = 'SELECT id, email, password FROM users WHERE id = :id';
        $records = $conn->prepare($query);
        $records->bindParam(':id',$_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $user = null;

        if (count($results) >0) {
            $user = $results;
        }
    }
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>PQR | SavingTheAmazon</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sticky-footer/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json>
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
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
    <link href="https://getbootstrap.com/docs/5.0/examples/sticky-footer/sticky-footer.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100">
    
<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
    <div class="row">
        <div class="col-md-2">
            <img class="mt-4" src="assets/img/logo.png" alt="" width="72" height="57">   
        </div>
        <div class="col-md-10">
            <h1 class="mt-5">Saving the Amazon</h1>
        </div>
    </div>
    <p class="lead">El modulo de PQR.</p>

    <?php if(empty($user)): ?>
      <p>Si ya estas registrado <a href="login.php">ingresa aquí</a> para al modulo de PQR.</p>
      <p>Registrarme <a href="signup.php">aquí</a> para acceder.</p>
    <?php endif; ?>

    <?php if(!empty($user)): ?>
      <p>Revisa <a href="dashboard.php">aquí </a>tus PQR's.</p>
    <?php endif; ?>
    
  </div>
</main>
    
  </body>
</html>
