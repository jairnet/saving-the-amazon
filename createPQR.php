<?php
    session_start();
    require 'database.php';

   if (isset($_SESSION['user_id'])) {
        $queryUsers = 'SELECT id, email FROM users';
        $recordsUsers = $conn->prepare($queryUsers);
        $recordsUsers->execute();
        $resultsUsers = $recordsUsers->fetchAll();

        $query = 'SELECT id, email, password, role FROM users WHERE id = :id';
        $records = $conn->prepare($query);
        $records->bindParam(':id',$_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $user = null;

        if (count($results) >0) {
            $user = $results;
        }
    }

    if($_POST){
        $message = "";
        $queryPQR = "INSERT INTO pqrs (user_id, type, topic, state, date_create, date_limit) VALUES (:user_id, :type, :topic, :state, :date_create, :date_limit)";
        $stamentPQR = $conn->prepare($queryPQR);
        $stamentPQR->bindParam(':user_id',$_POST['usuario'][0]);
        $stamentPQR->bindParam(':type',$_POST['tipo'][0]);
        $stamentPQR->bindParam(':topic',$_POST['asunto']);
        $stamentPQR->bindParam(':state',$_POST['estado'][0]);
        $stamentPQR->bindParam(':type',$_POST['tipo'][0]);
        $stamentPQR->bindParam(':date_create',$_POST['fechaCreacion']);
        $stamentPQR->bindParam(':date_limit',$_POST['fechaLimite']);
        
        if($stamentPQR -> execute()){
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
  <?php if(!empty($user)): ?>
    <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <p class="h5 my-0 me-md-auto fw-normal">Saving the Amazon</p>
        <nav class="my-2 my-md-0 me-md-3">
            <a class="p-2 text-dark"><?= $user['role'] ?> -></a>
            <a class="p-2 text-dark"><?= $user['email'] ?></a>
        </nav>
        <a class="btn btn-outline-success" href="logout.php">Salir</a>
    </header>
    <!-- Begin page content -->
    <main class="flex-shrink-0">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear</li>
            </ol>
        </nav>
        <h5>Ingresa los datos para crear la PQR</h5>

        
        <form class="row g-3" action="createPQR.php" method="POST">

            <?php if(!empty($message)): ?>
                <p><?= $message ?></p>
            <?php endif; ?>

            <div class="col-md-12">
                <label for="validationRole" class="form-label">Tipo PQR</label>
                <select class="form-select" id="validationRole" required name="tipo[]">
                    <option value="peticion">Petición</option>
                    <option value="queja">Queja</option>
                    <option value="reclamo">Reclamo</option>
                </select>
            </div>
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-text">Asunto PQR</span>
                    <textarea class="form-control" name="asunto" aria-label="With textarea"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationUser" class="form-label">Usuario</label>
                <select class="form-select" id="validationUser" required name="usuario[]">
                    <?php foreach ($resultsUsers as $key => $value) { ?>
                        <option value="<?=$value['id'];?>"><?=$value['email'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-12">
                <label for="validationRole" class="form-label">Estado</label>
                <select class="form-select" id="validationRole" required name="estado[]">
                    <option value="nuevo">Nuevo</option>
                    <option value="ejecucion">En Ejecucion</option>
                    <option value="cerrado">Cerrado</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="example-date-input" class="col-2 col-form-label">Fecha creación</label>
                <div class="col-10">
                    <input class="form-control" type="date" id="date-create" name="fechaCreacion">
                </div>
            </div>

            <div class="col-md-6">
                <label for="example-date-input" class="col-2 col-form-label">Fecha Limite</label>
                <div class="col-10">
                    <input class="form-control" type="date" id="date-limite" name="fechaLimite">
                </div>
            </div>

            <div class="col-12">
                <button class="btn btn-success" type="submit">Crear PQR</button>
            </div>
        </form>

    </div>
    </main>
    <?php endif; ?>
    
  </body>
</html>
