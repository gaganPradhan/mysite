
<div class="container">


    <?php if(!$log){?>
    <h2>User Login</h2>
    <form action="" method="post">
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="Username" required="" value="<?=set_value('username');?>">
            <?php echo form_error('username','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Password" required="">
          <?php echo form_error('password','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <input type="submit" name="loginSubmit" class="btn-primary" value="Submit"/>
        </div>
    </form>
    <p class="footInfo">Don't have an account? <a href="<?php echo base_url(); ?>users/create">Register here</a></p>
</div>
<?php } else {?>
<center><h2>You are already logged in. Go to your <a href="<?= base_url(); ?>users/account">profile</a></h2></center>
<?php }?>