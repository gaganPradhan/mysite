<h2><?=$title?></h2>

<?php foreach($users as $user){?>

	<ul>
		<li>			
			Username : <?php echo $user->username;?><br>
			Name :<a href = "<?php echo site_url('users/'.$user->id); ?>"> <?php echo $user->name;?></a>
							
			Image:<img src='./uploads/<?=$user->image;?>' width="50px" height="50px">
		</li>
	</ul>
	
<?php }?>