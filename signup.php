<?php
    require 'database.php';

    $message = '';
    if($_POST){
        $query = "INSERT INTO users (email, password, name, last_name, role) VALUES (:email, :password, :name, :last_name, :role)";
        $stament = $conn->prepare($query);
        $stament->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stament->bindParam(':password',$password);
        $stament->bindParam(':name',$_POST['name']);
        $stament->bindParam(':last_name',$_POST['last']);
        $stament->bindParam(':role',$_POST['role'][0]);
        
        if($stament -> execute()){
            $message = 'Registro exitoso';
            }else{
            $message = 'Error al registrarse';
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
<link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
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
          <a href="index.php"><img class="mt-4" src="assets/img/logo.png" alt="" width="72" height="57"></a>
      </div>
      <div class="col-md-8">
          <h1 class="mt-5">Saving the Amazon</h1>
      </div>
      <div class="col-md-2">
          <a href="login.php">Ingresar</a>
      </div>
    </div>

    <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <form class="row g-3" action="signup.php" method="POST">
        <div class="col-md-6">
            <label for="validationDefault01" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="validationDefault01" name="name" required>
        </div>
        <div class="col-md-6">
            <label for="validationDefault02" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="validationDefault02" name="last" required>
        </div>
        <div class="col-md-6">
            <label for="validationDefaultUsername" class="form-label">Correo Electrónico</label>
            <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2">@</span>
            <input type="mail" class="form-control" id="validationDefaultUsername"  name="email" aria-describedby="inputGroupPrepend2" required>
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationPassword" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="validationPassword" name="password" required>
        </div>
        <div class="col-md-12">
            <label for="validationRole" class="form-label">Rol</label>
            <select class="form-select" id="validationRole" required name="role[]">
                <option value="user">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
        </div>
        <div class="col-12">
            <button class="btn btn-success" type="submit">Registrarse</button>
        </div>
    </form>
  </div>
</main>
  </body>
</html>



