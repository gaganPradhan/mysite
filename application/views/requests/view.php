<div class='container'>
	<div class="col-md-3">
		<h2>Request Id: <?php echo $users->id;?></h2>
	</div>
	<div class="col-md-9">
		<b>Name</b><br>
		<?php echo $users->inventory_name;?><br><br>
		<b>Details</b><br>
		<?php echo $users->detail;?>
		<?php if($this->session->userdata('status')):?>			
			<?=form_open('requests/view')?>		
			<select name="status">
				<option value=<?=$users->status?>><?=$users->status?></option>
				<option value="pending">Pending</option>
				<option value="completed">Completed</option>
				<option value="Cancelled">Cancelled</option>
			</select>
			<br>
			<br>
			<?=form_label('Remarks')?>
			<?=form_textarea(['name'=>'remarks', 'id' => 'editor1', 'value' => $users->remarks]);?>
			<?=form_hidden('id', $users->id);?>
			<input type='submit' name='submit' value='Submit'/>
			</form>
		<?php endif;?>
	</div>
</div>
