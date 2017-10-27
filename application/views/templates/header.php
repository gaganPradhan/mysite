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
     <?php if($this->session->has_userdata('username')){ ?>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="">        	
        		<?= $this->session->userdata('username'); ?>        	
        <span class="caret"></span></a>
        <ul class="dropdown-menu">  
          <li><a href="<?php echo base_url();?>users/account">Profile</a></li>
          <li><a href="">Update</a></li>
          <li><a href="<?php echo base_url();?>users">List Users</a></li>
          <li><a href="<?php echo base_url();?>users/create">Register A User</a></li>                    
        </ul>
      </li>
      <?php }else {?>
      	<li><a href="<?php echo base_url();?>users/create">Register</a></li>
      <?php } ?>
      <li><a href="<?php echo base_url();?>requests">Requests</a></li> 
      <?php if($this->session->has_userdata('username')){ ?>
        	<li><a href="<?php echo base_url();?>users/logout">Log out</a></li>	 
       <?php 	}else{ ?>
       		<li><a href="<?php echo base_url();?>users/login">Log in</a></li>
   
       <?php } ?>
     
    </ul>
  </div>
</nav>		
 
 
    
		
	