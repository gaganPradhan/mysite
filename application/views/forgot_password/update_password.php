<?= form_open('forgotpassword/update_password/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)); ?>
  
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
     <?php echo validation_errors(); ?> 
      <h1 class="text-center"><?= 'Update Password'; ?> </h1>

      <div class="form-group">
        <label for="email">Email</label>
        <?php if(isset($email_hash, $email_code)): ?>
          <?= form_hidden('email_hash', $email_hash); ?>
          <?= form_hidden('email_code', $email_code); ?>

      <?php endif; ?>
        <?= form_input(['name' => 'email', 'class' => 'form-control', 'value' => $this->uri->segment(3)]);  ?> 

      </div>

       <div class="form-group">
        <label for="new_password">New Password</label>
        <?= form_password(['name' => 'new_password', 'class' => 'form-control', ]);  ?> 
      </div>
      
      <div class="form-group">
        <label for="new_password_again">Confirm New Password</label>
        <?= form_password(['name' => 'new_password_again', 'class' => 'form-control', ]);  ?> 
      </div>
      <?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Update Password'); ?>

    </div>
  </div>
 
<?= form_close(); ?>