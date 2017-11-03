	<?=form_open('forgotpassword');?>

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
 	<?=form_submit('submit','Submit');?>