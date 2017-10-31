<h2><?=$title?></h2>
<?php if(!$this->session->userdata('username') || !$this->session->userdata('status')):?>
	<h3><center>You dont have the privilege</center></h3>
<?php else:?>

<?php foreach($users as $user){?>


<div class="row">	
	
	<div class="col-md-3">
		<img class="post-thumb" src='<?=site_url('/assets/images/'.$user->image); ?>' width = "200" height = "200">
	</div>
	<div class="col-md-9">
		Username : <?php echo $user->username;?><br>
			Name :<a href = "<?php echo site_url('users/'.$user->id); ?>"> <?php echo $user->name;?></a><br>
		
	</div>
</div>
<br>

	
<?php }?>
<div class="pagination-links">
		<?php echo $this->pagination->create_links(); ?>
</div>
<?php endif;?>