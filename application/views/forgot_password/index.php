<?php 

mail('gagan.pradhan@hotmail.com', 'My Subject', 'asdasds', 'From: namoshi.test@gmail.com');
if($error) {
  echo $error;
}

?>

<?= form_open('forgotpassword'); ?>
  
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <?php echo validation_errors(); ?>
      <h1 class="text-center"><?= $title; ?> </h1>

       <div class="form-group">
        <label for="email">Email</label>
        <?= form_input(['name' => 'email', 'class' => 'form-control', 'value' => set_value('email'), 'placeholder' => 'Enter Email']);  ?> 
      </div>

      <?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Reset my password'); ?>

    </div>
  </div>
 
<?= form_close(); ?>

<!-- 'autocomplete' => 'off' -->