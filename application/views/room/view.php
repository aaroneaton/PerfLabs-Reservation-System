<div class="row">
  <div class="span8">
    <h1>Room</h1>
  </div>
  <div class="span4">
    <?php echo anchor( 'room/edit/' . $room['room_id'], 'Edit', array( 'class' => 'btn btn-primary' ) ); ?>
  </div>
</div>
<div class="row">
	<div class="span12">
		<p>
      <b>Building: </b><?php echo $room['bldg']; ?>
		</p>
		<p>
      <b>Room: </b><?php echo $room['number']; ?>
		</p>
	</div>
</div>
