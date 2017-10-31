
<?php if($this->session->has_userdata('username')) {?>
<center><h1><?=$title?></h1></center>
<?php if(!$request){?>
<?=form_open_multipart('requests/index');?>
<div class="container">
	
	<?=form_label('Inventory Name');?><br>
	<?=form_input('name', set_value('name'));?>
	<?=form_error('name');?><br>
	
	<?=form_label('Details');?><br>	
	<?=form_textarea(['name'=>'detail', 'id' => 'editor1']);?>
	<?=form_error('detail');?><br>

	<?=form_hidden('time', time());?><br>
	<?=form_hidden('username', $this->session->userdata('username'));?>
	<input type='submit' name='submit' value='Submit'/>
</form>
<?php } else { ?>
<center><h2>You have a pending request.</h2></center>
<br><br>
<table class='table'>
	<tr>
		<th>Inventory Request</th>
		<th>Requested Date</th>
		<th>Status</th>		
	</tr>
	<tr>		
		<td><?php echo $request->inventory_name;?><br></td>		
		<td><?php echo $request->request_date;?></td>
		<td><?php echo $request->status;?> </td>	
	</tr>	
</table>
<?php }?>
 <?php 
}else {?>

<center><h2>Please <a href="<?=base_url();?>users/login">Log in</a> to request inventory.</h2></center>
<?php } ?>
