<div class="row">
	<div class="span12">
		<h1 class="page-header">Create New User</h1>
	</div>
</div>
<div class="row">
  <div class="span12">
<?php echo validation_errors(); ?>

<?php echo form_open( 'user/create', $form_attr ); ?>
  <fieldset>
  	<div class="control-group">
      <label for="net_id" class="control-label">NetID</label>
      <div class="controls">
        <?php echo form_input( $form_fields['net_id'] ); ?>
      </div>
  	</div>
  	<div class="control-group">
  		<label for="user_role" class="control-label">User Role</label>
      <div class="controls">
        <?php echo form_dropdown( 'user_role', $form_fields['user_role']['options'] ); ?>
      </div>
    </div>
    <div class="form-actions">
      <?php echo form_submit( $form_fields['form_submit'] ); ?>
      <a href="user" class="btn">Cancel</a>
    </div>
  </fieldset>
<?php echo form_close(); ?>
  </div>
</div>
