<?php if(!$this->session->userdata('username') || !$this->session->userdata('status')):?>
	<h3><center>You dont have the privilege</center></h3>
<?php else:?>
<div class="row">	
	
	<div class="col-md-3">
		<img src='<?=site_url('/assets/images/'.$users->image);?>' width = "200" height = "200">
	</div>
	<div class="col-md-9">
		Username : <?php echo $users->username;?><br>
		Name :<a href = "<?php echo site_url('users/'.$users->id); ?>"> <?php echo $users->name;?></a><br>
		<a href="<?=site_url('/users/delete/'.$users->id)?>">Delete</a>
	</div>
</div>
<br>
<?php endif;?>