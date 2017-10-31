<h2><center><?=$title?></center></h2>
<div class='table-responsive'>
<table class='table'>
	<tr>
		<th>S.N.</th>
		<th>Username</th>
		<th>Inventory Request</th>
		<th>Name</th>
		<th>Requested Date</th>
		<th>Department</th>		
		<th>Status</th>	
		<th>Updated On</th>
	</tr>
<?php 
$i = 0;
foreach($users as $user){?>
<tr>	<th><?=++$i?></th>
		<td><?php echo $user->username;?><br></td>
		<td><?php echo $user->inventory_name;?><br></td>
		<td><a href = "<?php echo site_url($user->id); ?>">Detail</a><br></td>
		<td><?php echo $user->request_date;?></td>
		<td><?php echo $user->department_name;?> </td>	
		<td><?php echo $user->status;?> </td>	
		<td><?php echo $user->updated_date;?></td>
		

</tr>	
<?php }?>
</table>
