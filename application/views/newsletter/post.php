
<?php if($this->session->has_userdata('username')) {?>
<center><h1><?=$title?></h1></center>


<?=form_open_multipart('newsletter/post');?>
<div class="container">
	
	<?=form_label('Title');?><br>
	<?=form_input('title', set_value('title'));?>
	<?=form_error('title');?><br>
	
	<?=form_label('Body');?><br>	
	<?=form_textarea(['name'=>'body', 'id' => 'editor1']);?>
	<?=form_error('body');?><br>

	<?=form_hidden('date', date("F j, Y, g:i a"));?><br>
	<?=form_hidden('username', $this->session->userdata('username'));?>

	<?=form_label('Upload an image');?><br>
	<?=form_upload('image');?>
	<?php if(!empty($errors)) 
		{foreach($errors as $error){
			echo $error . PHP_EOL;
		}
	}?>
	<input type='submit' name='submit' value='Submit'/>
</form>
<?php
}else {?>

<center><h2>Please <a href="<?=base_url();?>users/login">Log in</a> to post.</h2></center>
<?php } ?>
