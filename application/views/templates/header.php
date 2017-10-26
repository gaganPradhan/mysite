<html>
	<head>
		<title>
		Frame Work
		</title>		
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>

	<body>
		<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo base_url();?>">RequestInventory</a>
    </div>
    <ul class="nav navbar-nav">
     
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url();?>users">Users
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url();?>users">List</a></li>
          <li><a href="<?php echo base_url();?>users/create">Create</a></li>
          <li><a href="<?php echo base_url();?>users/login">Login</a></li>          
        </ul>
      </li>
      <li><a href="<?php echo base_url();?>requests">Requests</a></li>  
    </ul>
  </div>
</nav>		
 
 
    
		
	