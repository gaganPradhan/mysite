<div class='container'>

	<div class="col-md-3" >
		<h2>News Id: <?php echo $news->id;?></h2><br>
		<img src="<?=site_url('/assets/images/'.$news->image);?>" width = "200" height = "200">
	</div>
	<div class="col-md-9">

		<b>Name</b><br>
		<?php echo $news->title;?><br><br>
		<b>Body</b><br>
		<?php echo $news->body;?><br>	

		<a href="<?=site_url('/newsletter/delete/'.$news->id)?>">Delete Account</a><br>

		
	</div>
</div>
