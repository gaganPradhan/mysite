<h2><center><?php echo $title; ?></center></h2>
<?php if($this->session->userdata('username') && !$this->session->userdata('status')):?>
	<h3><center>You need to log out</center></h3>
<?php else:?>
<?php echo form_open_multipart('users/create');?>
<?php 
	
?>	
	<?=form_label('Username');?><br>
	<?php 
        $data = [
            'name' => 'username',
            'class' => 'form-control',
            'value' => set_value('username'),
            'autocomplete' => 'off'                   
        ];
    ?>            
    <?= form_input($data);?> 	
	<?=form_error('username');?><br>
	<?=form_label('Name');?><br>
	<?php 
        $data = [
            'name' => 'name',
            'class' => 'form-control',
            'value' => set_value('name'),
            'autocomplete' => 'off'                       
        ];
    ?>            
    <?= form_input($data);?> 	
	<?=form_error('username');?><br>

	<?=form_label('Password');?><br>
	<?php 
        $data = [
            'name' => 'password',
            'class' => 'form-control'                 
        ];
    ?>         
    <?= form_password($data);?>
    <?=form_error('password');?><br> 	
	
	<?=form_label('Password Again');?><br>
	<?php 
        $data = [
            'name' => 'passconf',
            'class' => 'form-control'                  
        ];
    ?>       
   	<?=form_password($data);?>
   	<?=form_error('passconf');?><br> 	

	<?=form_label('Email');?><br>
	<?php 
        $data = [
            'name' => 'email',
            'class' => 'form-control',
            'value' => set_value('email'),
            'autocomplete' => 'off'   
        ];                   
    ?>            
    <?= form_input($data);?>
    <?=form_error('email');?><br> 	
 	
	<?=form_label('Upload an image');?><br>
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
		echo form_dropdown('department', $option, 1);	
	?><br>	
	
	<?php if($this->session->userdata('status')) {
		$data = [
	        'name'          => 'admin',
	        'id'            => 'admin',
	        'value'         => 'Admin',
	        'checked'       => FALSE,
	        'style'         => 'margin:10px'
		];
		echo form_label('Admin');
		echo form_checkbox($data);
	}

	?>
	
	<?=form_hidden('time', time());?><br>
	<input type='submit' name='submit' value='Sign up'/>
</form>
</div>
<?php endif;?>