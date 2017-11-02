
<?=form_open('users/update/pswrdchng');?>
<?=form_label('Old Password');?><br>
    <?php 
        $data = [
            'name' => 'org_password',
            'class' => 'form-control'                 
        ];
    ?>         
    <?= form_password($data);?>
    <?=form_error('org_password');?><br>    

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
            'class' => 'form-control',           
        ];
    ?>       
   	<?=form_password($data);?>
   	<?=form_error('passconf');?><br> 
    <?=form_hidden('id', $users->id);?>

    <?=form_submit('submit', 'Submit');?>