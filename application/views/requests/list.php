<h2><center><?=$title?></center></h2>
<div class='table-responsive'>

<?php if(!empty($pending_requests)):?>
	

<table class='table'>
	<tr>
		<th>S.N.</th>
		<th>Username</th>
		<th>Inventory Request</th>
		<th>Requested Date</th>
		<th>Department</th>	
		<th>Updated On</th>
		<th>Remarks</th>
	</tr>
<?php 
$i = 0;
foreach($pending_requests as $pending_request){?>
	<tr>	
		<th><?=++$i?></th>
		<td><?php echo $pending_request->username;?><br></td>
		<td><a href = "<?php echo site_url($pending_request->id); ?>"><?php echo $pending_request->inventory_name;?></a><br></td>
		<td><?php echo $pending_request->request_date;?></td>
		<td><?php echo $pending_request->department_name;?> </td>		
		<td><?php echo $pending_request->updated_date;?></td>
		<td><?php echo character_limiter($pending_request->remarks, 5);?></td>
	</tr>	
<?php }?>
</table>
<?php else:?>
	<h2><center> No Pending Requests At The Moment. </center></h2>
<?php endif;?>
<br><br>

  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Show Cancelled Requests</button>
  <div id="demo" class="collapse">
  	<?php if(!empty($cancelled_requests)):?>
	<table class='table'>
		<tr>
			<th>S.N.</th>
			<th>Username</th>
			<th>Inventory Request</th>
			<th>Requested Date</th>
			<th>Department</th>		
			<th>Updated On</th>
			<th>Remarks</th>
		</tr>
	<?php 
	$i = 0;
	foreach($cancelled_requests as $cancelled_request){?>
		<tr>	
			<th><?=++$i?></th>
			<td><?php echo $cancelled_request->username;?><br></td>
			<td><a href = "<?php echo site_url($cancelled_request->id); ?>"><?php echo $cancelled_request->inventory_name;?></a><br></td>		
			<td><?php echo $cancelled_request->request_date;?></td>
			<td><?php echo $cancelled_request->department_name;?> </td>		
			<td><?php echo $cancelled_request->updated_date;?></td>
			<td><?php echo character_limiter($cancelled_request->remarks, 5);?></td>
		</tr>	
	<?php }?>
	</table>
	<?php else:?>
	<h2><center>No Cancelled Requests.</center></h2>
<?php endif;?>
  </div>
  

<br><br>


  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#complete">Show Completed Requests</button>
  <div id="complete" class="collapse">
  	<?php if(!empty($completed_requests)):?>
	
	 <table class='table'>
		<tr>
			<th>S.N.</th>
			<th>Username</th>
			<th>Inventory Request</th>
			<th>Requested Date</th>
			<th>Department</th>	
			<th>Updated On</th>
			<th>Remarks</th>
		</tr>


	<?php 
	$i = 0;
	foreach($completed_requests as $completed_request){?>
		<tr>	
			<th><?=++$i?></th>
			<td><?php echo $completed_request->username;?><br></td>
			<td><a href = "<?php echo site_url($completed_request->id); ?>"><?php echo $completed_request->inventory_name;?></a><br></td>
			<td><?php echo $completed_request->request_date;?></td>
			<td><?php echo $completed_request->department_name;?> </td>		
			<td><?php echo $completed_request->updated_date;?></td>
			<td><?php echo character_limiter($completed_request->remarks, 5);?></td>
		</tr>	
	<?php }?>
	</table>
<?php else:?>
	<h2><center>No Completed Requests.</center></h2>
<?php endif;?>
  </div>


<br><br>	




