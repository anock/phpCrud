<?php

include 'action.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD App</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">CRUD App</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
    </ul>
   
  </div>
  <form class="form-inline" action="/action_page.php">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-primary" type="submit">Search</button>
  </form>
</nav>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class = "col-md-10">
                <h3 class="text-center text-dark mt-2"> Crud Avançado usando PHP e mysqli orientado a objetos</h3>
                <hr>
                <?php if(isset($_SESSION['response'])){?>
                <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <b><?= $_SESSION['response'];?></b>
                </div>
                <?php } unset($_SESSION['response']); ?>
            </div>
           
        </div>
        <div class="row">
        <div class="col-md-4">
        <h3 class="text-center text info">ADD Record</h3>
        <form action="action.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $id; ?>">

        <div class="form-group">
            <input type="text" name="name" value="<?= $name;?>"class="form-control" placeholder="Enter name"require>
        </div>
        <div class="form-group">
            <input type="email" name="email" value="<?= $email;?>" class="form-control" placeholder="Enter your e-mail"require>
        </div>
        <div class="form-group">
            <input type="tel" name="phone" value="<?= $phone ; ?>" class="form-control" placeholder="Enter phone"require>

        </div>
        <div class="form-group">
          <input type="hidden" name="oldimage" value="<?= $photo;?>">
            <input type="file" name="image" class="custom-file">
            <img src="<?= $photo; ?>" width="200" class="img-thumbnail">
        </div>
        <div class="form-group">
                  <?php if($update==true){?>
                    <input type="submit" name="update" class="btn btn-success btn-block" value="Update Record">
                  <?php } else{?>

            <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
                  <?php }?>
        </div>

        </form>
        </div>
        <div class="col-md-8">
          <?php
          
                $query = "SELECT * FROM CRUD";  
                $stmt = $conn->prepare($query);
                $stmt ->execute();
                $result = $stmt->get_result();
          
          
          ?>
        <h3 class="text-center text-info">Record present in the dataBase </h3>
        <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Image</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row=$result ->fetch_assoc()){ ?>
      <tr>
        <td><?= $row['id']; ?></td>
        <td><img src="<?= $row['photo']; ?>" width="50"></td>
        <td><?= $row['name']; ?> </td>
        <td><?= $row['email']; ?></td>
        <td> <?= $row['phone']; ?></td>
        <td>
            <a href="details.php?details=<?=$row['id']; ?>  " class="badge badge-primary p-2">Details</a>
            <a href="action.php?delete=<?=$row['id']; ?>" class="badge badge-danger p-2" onclick ="return confirm('Esta certo disso?');">Delete</a>
            <a href="index.php?edit=<?=$row['id']; ?>" class="badge badge-success p-2">edit</a>

        </td>
      </tr>
      <?php } ?>
     
    </tbody>
  </table>
        </div>

        </div>

    </div>

    
</body>
</html>