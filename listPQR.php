<?php
    session_start();
    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $queryPQR = 'SELECT * FROM pqrs';
        $recordsPQR = $conn->prepare($queryPQR);
        $recordsPQR->execute();
        $resultsPQR = $recordsPQR->fetchAll();

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
                <li class="breadcrumb-item active" aria-current="page">Lista PQR's</li>
            </ol>
        </nav>
        
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Tipo</th>
                <th scope="col">Asunto</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha Creación</th>
                <th scope="col">Fecha Limite</th>
                <th scope="col">Notificar Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultsPQR as $key => $value) { ?>
                    <tr>
                    <th scope="row"><?=$value['id'];?></th>
                    <td><?=$value['type'];?></td>
                    <td><?=$value['topic'];?></td>
                    <td><?=$value['state'];?></td>
                    <td><?=$value['date_create'];?></td>
                    <td><?=$value['date_limit'];?></td>
                    <td><a href="notifyPQR.php?id=<?php echo $value['id']; ?>" class="btn btn-outline-info">Enviar</a></td>
                    <?php if($value['state']=='cerrado'): ?>
                      <td><button type="button" class="btn btn-outline-success" disabled>Editar</button></td>
                    <?php endif; ?>
                    <?php if($value['state']!='cerrado'): ?>
                      <td><a href="editPQR.php?id=<?php echo $value['id']; ?>" class="btn btn-outline-success">Editar</a></td>
                    <?php endif; ?>
                    
                    <td><a href="deletePQR.php?id=<?php echo $value['id']; ?>" class="btn btn-outline-danger">Eliminar</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </main>
    <?php endif; ?>
    
  </body>
</html>