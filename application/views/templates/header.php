<html>
	<head>
		<title>
		<?=$title?>
		</title>		
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  
      <link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
      <?=link_tag('css/style.css');?>
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
          <li><a href="<?php echo base_url('users/account/'.$this->session->userdata('username'));?>">Profile</a></li>
          <li><a href="<?=base_url();?>users/update">Update</a></li>          
          <?php if($this->session->userdata('status')):?>
            <li><a href="<?php echo base_url();?>users">List Users</a></li>
            <li><a href="<?php echo base_url();?>users/create">Register A User</a></li>
          <?php endif;?>                    
        </ul>
      </li>
      <?php }?>
      <li><a href="<?php echo base_url();?>list">Requests</a></li>
      </ul>     
      <ul class="nav navbar-nav navbar-right">
          <?php if(!$this->session->userdata('username')) : ?>
            <li><a href="<?php echo base_url();?>users/create">Register</a></li>
            <li><a href="<?php echo base_url(); ?>users/login">Login</a></li>
          <?php elseif($this->session->userdata('username')):?>
            <li><a href="<?php echo base_url(); ?>users/logout">Logout</a></li>
          <?php endif; ?>
     </ul
  </div>
</nav>		


<div class='container'>
<?php 
if($this->session->flashdata('error')){
echo $this->session->flashdata('error');
}
if($this->session->flashdata('register')){
echo "<p class = 'alert alert-success'>".$this->session->flashdata('register')."</p>";
}
if($this->session->flashdata('login')){
echo "<p class = 'alert alert-success'>".$this->session->flashdata('login')."</p>";
}
if($this->session->flashdata('update')){
echo "<p class = 'alert alert-success'>".$this->session->flashdata('update')."</p>";
}
if($this->session->flashdata('delete')){
echo "<p class = 'alert alert-success'>".$this->session->flashdata('delete')."</p>";
}
if($this->session->flashdata('notification')){
echo "<p class = 'alert alert-success'>".$this->session->flashdata('notification')."</p>";
}
?>
 
 
    
		
	