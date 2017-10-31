<h2><center><?php echo $title; ?></center></h2>
<?php echo form_open_multipart('users/update');?>
<?php 
	$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
	);
?>	<div class="container">
	<?=form_label('Username');?><br>
	<?php 
        $data = [
            'name' => 'username',
            'class' => 'form-control',
            'value' => $users->username                    
        ];
    ?>            
    <?= form_input($data);?> 	
	<?=form_error('username');?><br>
	<?=form_label('Name');?><br>
	<?php 
        $data = [
            'name' => 'name',
            'class' => 'form-control',
            'value' => $users->name                    
        ];
    ?>            
    <?= form_input($data);?> 	
	<?=form_error('username');?><br>          
	
	<?=form_label('Email');?><br>
	<?php 
        $data = [
            'name' => 'email',
            'class' => 'form-control',
            'value' => $users->email 
        ];                   
    ?>            
    <?= form_input($data);?>
	<?=form_label('Change Your Image');?><br>
	<img src="<?=site_url('/assets/images/'.$users->image)?>" width='100' height='100'>
	<?=form_upload('image');?>
	<?php if(!empty($errors)) 
		{foreach($errors as $error){
			echo $error . PHP_EOL;
		}
	}?>
	<?=form_label('Select Department');?><br>
	<?php
	foreach($departments as $department){
			$option[$department->id] = $department->department_name;
		}
		echo form_dropdown('department', $option, $users->dpt_id);	
	?><br>
	<?php if(!empty($errors)) 
		{foreach($errors as $error){
			echo $error . PHP_EOL;
		}
	}?>
	<?=form_hidden('time', time());?><br>
	<?=form_hidden('id', $users->id);?><br>
	<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
	<input type='submit' name='submit' value='Update'/>
</form>
</div>