<?php if(!$this->session->userdata('username') || !$this->session->userdata('status')):?>
	<h3><center>You dont have the privilege</center></h3>
<?php else:?>
<div class="row">	
	
	<div class="col-md-3">
		<img src='<?=site_url('/assets/images/'.$users->image); ?>' width = "200" height = "200">
	</div>
	<div class="col-md-9">
		<table>			
			<tr>

				<td>Username </td><td> :  <?php echo $users->username;?></td>
				
			</tr>
			<tr>
				<td>Name </td><td>:  <?php echo $users->name;?></td>
			</tr>
			<tr>
				<td>Department</td><td>:  <?= $department->department_name;?></td>
			</tr>		
			<tr>
				<td>Email</td><td>:  <?= $users->email;?></td>
			</tr>		
		</table>
		<br><br><br>
		<a href="<?=site_url('/users/delete/'.$users->id)?>">Delete Account</a><br>

	</div>
<br>
<?php endif;?>