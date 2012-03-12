<div class="row">
	<div class="span8">
		<h1>Editing Room</h1>
	</div>
	<div class="span4"></div>
</div>
<div class="row">
	<div class="span12">
<?php echo validation_errors(); ?>
<?php echo form_open( 'room/edit/' . $hidden['room_id'], $form_attr, $hidden ); ?>
		<div class="control-group">
			<label for="building">Building: </label>
      <div class="controls">
        <?php echo form_input( $form_fields['building'] ); ?>
      </div>
		</div>
		<div class="control-group">
			<label for="room">Room: </label>
      <div class="controls">
        <?php echo form_input( $form_fields['room'] ); ?>
      </div>
		</div>
		
    <div class="form-actions">
<?php echo form_submit( $form_fields['form_submit'] ); ?>
    </div>
<?php form_close(); ?>
	</div>
</div>
