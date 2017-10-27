<h2><?php echo $title; ?></h2>
<?php echo form_open_multipart('users/create');?>
<?php 
	$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
	);
?>	<div class="container">
	<?=form_label('Username');?>
	<?=form_input('username', set_value('username'));?>
	<?=form_error('username');?><br>
	<?=form_label('Name');?>
	<?=form_input('name', set_value('name'));?>
	<?=form_error('name');?><br>
	<?=form_label('Password');?>
	<?=form_password('password');?>
	<?=form_error('password');?><br>
	<?=form_label('Password Again');?>
	<?=form_password('passconf');?>
	<?=form_error('passconf');?><br>
	<?=form_label('Email');?>
	<?=form_input('email', set_value('email'));?>
	<?=form_error('email');?><br>
	<?=form_label('Upload an image');?>
	<?=form_upload('image');?>
	<?=form_label('Select Department');?>
	<?php
	foreach($departments as $department){
			$option[$department->id] = $department->department_name;
		}
		echo form_dropdown('department', $option, 1);	
	?><br>
	<?php if(!empty($errors)) 
		{foreach($errors as $error){
			echo $error . PHP_EOL;
		}
	}?>
	<?=form_hidden('time', time());?>
	<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
	<input type='submit' name='submit' value='Sign up'/>
</form>
</div>