<h2><?=$title?></h2>
<table border="6">
	<tr>
		<th>Username</th>
		<th>Inventory Request</th>
		<th>Name</th>
		<th>Requested Date</th>
		<th>Department</th>		
	</tr>
<?php foreach($users as $user){?>
<tr>	
		<td><?php echo $user->username;?><br></td>
		<td><?php echo $user->inventory_name;?><br></td>
		<td><a href = "<?php echo site_url($user->id); ?>">Detail</a><br></td>
		<td><?php echo $user->request_date;?></td>
		<td><?php echo $user->department_name;?> </td>	

</tr>	
<?php }?>
</table>