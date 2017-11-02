<h3>Admins</h3>
<?php foreach($users as $user){
if(strcmp($user->username, $this->session->userdata('username'))==0){
	continue;
}
?>
<?php if($user->groups == 2):?>
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

<?php endif;?>	
<?php }?>
<h3>Users</h3>
<?php foreach($users as $user){
if(strcmp($user->username, $this->session->userdata('username'))==0){
	continue;
}
?>
<?php if($user->groups != 2):?>
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

<?php endif;?>	
<?php }?>

<div class="pagination-links">
		<?php echo $this->pagination->create_links(); ?>
</div>