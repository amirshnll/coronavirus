<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="amirsh.nll@gmail.com">
    <title>Coronavirus - Login</title>
    <link rel="stylesheet" href="{base}assets/css/layout.css">
  	<link rel="stylesheet" href="{base}assets/lib/bootstrap/css/bootstrap.min.css">
  	<link rel="stylesheet" href="{base}assets/lib/bootstrap/css/bootstrap-grid.min.css">
  	<link rel="stylesheet" href="{base}assets/lib/fontawesome/css/all.min.css">
  	<link rel="stylesheet" href="{base}assets/lib/datatable/datatables.min.css"/>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<link rel="shortcut icon" href="{base}assets/img/favicon.png" type="image/png" sizes="32x32" />
  	<link rel="icon" href="{base}assets/img/favicon.png" type="image/png" sizes="32x32">
  </head>

  <body class="text-center bootstrap_body">

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#"><img src="{base}assets/img/logo.png" alt="" width="22" height="22"> Coronavirus</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarCollapse" style="">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="{base}">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{base}login">Login <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{base}detect">Detect</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{base}statistics">Statistics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{base}export">Export</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://github.com/amirshnll/coronavirus" target="_blank">Project</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <form class="form-signin" method="post" action="{base}auth">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
      <img class="mb-4" src="{base}assets/img/logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputUsername" class="sr-only">Username</label>
      <input type="username" id="inputUsername" class="form-control"name="username" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <br />
      {form_error}
      <p class="mt-5 mb-3 text-muted">&copy; 2020 All rights reserved | <a class="text-muted" href="https://amirshnll.ir" title="A.shokri" target="_blank">A.shokri</a></p>
      <p><a class="text-muted" href="{base}" title="Back To Home">Back To Home</a></p>
    </form>

    <script src="{base}assets/lib/bootstrap/js/bootstrap.min.js"></script>
	  <script src="{base}assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
