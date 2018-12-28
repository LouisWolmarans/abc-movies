<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $page_title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>theme/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>theme/css/half-slider.css" rel="stylesheet">
	
	<!-- Font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- Datatables -->
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">ABC Movies</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
		  <?php if($this->session->userdata('user_id') == ''){ ?>
			<li class="nav-item">
              <a class="nav-link" href="login"><i class="fa fa-fw fa-sign-out"></i> Login</a>
            </li>
		  <?php } else { ?>
			<li class="nav-item">
              <a class="nav-link" href="watchlist">My Watch List</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" id="logout" style="cursor:pointer"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
            </li>
		  <?php } ?>           
          </ul>
        </div>
      </div>
    </nav>