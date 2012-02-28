<div class="row">
	<div class="span10">
  <h1>Editing User</h1>
	</div>
	<div class="span2"></div>
</div>
<div class="row">
  <div class="span12">
<?php echo validation_errors(); ?>
  <?php echo form_open( 'user/edit/' . $hidden['user_id'], $form_attr, $hidden ); ?>
    <div class="control-group">
      <label for="first_name" class="control-label">First Name:</label>
      <div class="controls">
<?php echo form_input( $form_fields['first_name'] ); ?>
      </div>
    </div>
    <div class="control-group">
      <label for="last_name" class="control-label">Last Name:</label>
      <div class="controls">
<?php echo form_input( $form_fields['last_name'] ); ?>
      </div>
    </div>
    <div class="control-group">
      <label for="email" class="control-label">Email Address:</label>
      <div class="controls">
<?php echo form_input( $form_fields['email'] ); ?>
      </div>
    </div>
    <div class="control-group">
      <label for="phone" class="control-label">Phone Number:</label>
      <div class="controls">
<?php echo form_input( $form_fields['phone'] ); ?><small>xxx-xxx-xxxx</small>
      </div>
    </div>
    <div class="control-group">
      <label for="net_id" class="control-label">NetID:</label>
      <div class="controls">
<?php echo form_input( $form_fields['net_id'] ); ?>
      </div>
    </div>
    <div class="control-group">
      <label for="uin" class="control-label">UIN:</label>
      <div class="controls">
<?php echo form_input( $form_fields['uin'] ); ?>
      </div>
    </div>
    <div class="control-group">
      <label for="user_role" class="control-label">User Role:</label>
      <div class="controls">
        <?php
          // Check if user is admin
          $session = $this->session->userdata( 'user_data' );
          ( $session['user_role'] != 50 ) ? $disabled = 'disabled' : $disabled = '';

          echo form_dropdown( $form_fields['user_role']['name'], $form_fields['user_role']['options'], $form_fields['user_role']['selected'], $disabled );
        ?>
      </div>
    </div>
    <div class="form-actions">
<?php echo form_submit( $form_fields['form_submit'] ); ?>
    </div>
<?php echo form_close(); ?>
  </div>
</div>
