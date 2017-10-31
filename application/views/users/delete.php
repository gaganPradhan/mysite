
<?=form_open('users/delete/'.$this->uri->segment(3))?>
<div style="
    display: inline-block;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 200px;
    height: 150px;
    margin: auto;
    background-color: #f3f3f3;">
<center><h1> ARE YOU SURE? </h1></center>

<CENTER><h2>
	<?=form_submit('delete', 'Yes');?>
	<?=form_submit('no', 'No');?>
</h2>

</CENTER>
	

</div>