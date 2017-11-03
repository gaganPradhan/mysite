<h2><center><?=$title?></center></h2>
<div class='table-responsive'>	

<table class='table'>
	<tr>
		<th>S.N.</th>
		<th>Username</th>
		<th>Title</th>
		<th>Date</th>
		<th>Department</th>	
		<th>Body</th>
	</tr>
<?php 
$i = 0;
foreach($newsletters as $newsletter){?>
	<tr>	
		<th><?=++$i?></th>
		<td><?php echo $newsletter->username;?><br></td>
		<td><a href = "<?php echo site_url('newsletter/'.$newsletter->id); ?>"><?php echo $newsletter->title;?></a><br></td>
		<td><?php echo $newsletter->date;?></td>
		<td><?php echo $newsletter->department_name;?> </td>
		<td><?php echo character_limiter($newsletter->body, 5);?></td>
	</tr>	
<?php }?>
</table>

<br><br>
